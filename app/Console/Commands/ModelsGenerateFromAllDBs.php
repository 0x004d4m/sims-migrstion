<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class ModelsGenerateFromAllDBs extends Command
{
    protected $signature = 'sims:models-generate';

    protected $description = 'Generate models based on database tables';

    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    public function handle()
    {
        $databaseConnections = config('database.connections');

        foreach ($databaseConnections as $connectionName => $connectionConfig) {
            // Set the connection for the current iteration
            config(['database.default' => $connectionName]);

            // Get table names from the current database
            $tables = DB::connection($connectionName)->select('SHOW TABLES');

            foreach ($tables as $table) {
                $tableName = reset($table);
                $modelName = $this->generateModelName($connectionName, $tableName);
                $relationsships = $this->relationships($connectionName, $tableName);

                // Generate a model based on the table name
                $this->call('make:model', ['name' => $modelName]);

                // Check if the table has a "deleted_at" column
                $hasSoftDeletes = $this->hasSoftDeletes($tableName, $connectionName);
                $hasTimeStamps = $this->hasTimeStamps($tableName, $connectionName);

                // Define the fillable attributes
                $columns = DB::connection($connectionName)->getSchemaBuilder()->getColumnListing($tableName);
                $fillable = $this->generateFillableArray($columns);

                // Update the generated model with connection, fillable, and SoftDeletes
                $modelPath = app_path('Models/' . str_replace('\\', '/', $modelName) . '.php');
                $this->updateModel($modelPath, $fillable, $hasSoftDeletes, $hasTimeStamps, $connectionName, $modelName, $tableName, $relationsships);
            }
        }

        $this->info('Models generated successfully');
    }

    private function hasSoftDeletes($tableName, $connectionName)
    {
        $columns = DB::connection($connectionName)->getSchemaBuilder()->getColumnListing($tableName);
        return in_array('deleted_at', $columns);
    }

    private function hasTimeStamps($tableName, $connectionName)
    {
        $columns = DB::connection($connectionName)->getSchemaBuilder()->getColumnListing($tableName);
        return !(in_array('created_at', $columns));
    }

    private function generateModelName($connectionName, $tableName)
    {
        $namespace = ucfirst($connectionName);
        $modelName = Str::studly($tableName);
        return "$namespace\\$modelName";
    }

    private function updateModel($modelPath, $fillable, $hasSoftDeletes, $hasTimeStamps, $connectionName, $modelName, $tableName, $relationsships)
    {
        $modelContents = $this->filesystem->get($modelPath);

        // Define the connection and fillable properties within the class
        $connectionProperty = "protected \$connection = '$connectionName';\n";
        $tableProperty = "protected \$table = '$tableName';\n";
        $fillableProperty = "protected \$fillable = ['" . implode('\',\'', $fillable) . "'];\n";

        // Add the SoftDeletes trait and property if needed
        $softDeletesNameSpace = $hasSoftDeletes ? "\nuse Illuminate\Database\Eloquent\SoftDeletes;\n\n" : "\n\n";
        $softDeletes = $hasSoftDeletes ? "\n\tuse SoftDeletes;\n" : "";
        $timeStamps = $hasTimeStamps ? "\n\tpublic \$timestamps = false;\n" : "";

        // Replace the entire class definition
        $modelClass = "class " . class_basename($modelName) . " extends Model\n";
        $classDefinition = "{$softDeletesNameSpace}{$modelClass}{\n\tuse HasFactory;{$timeStamps}{$softDeletes}\n\t{$tableProperty}\n\t{$connectionProperty}\n\t{$fillableProperty}\n{$relationsships}";

        // Replace the existing class definition
        $modelContents = str_replace("\n    use HasFactory;", '', $modelContents);
        $modelContents = preg_replace("/(\n+class\s+\w+\s+extends\s+Model+\n{+\n)/", $classDefinition, $modelContents);

        $this->filesystem->put($modelPath, $modelContents);
    }

    private function generateFillableArray($columns)
    {
        return $columns;
    }

    private function relationships($db, $table)
    {
        $relationships = [];

        // Get relations from the current database
        $foreignKeys = DB::select("SELECT COLUMN_NAME, TABLE_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME, CONSTRAINT_SCHEMA
        FROM information_schema.key_column_usage
        WHERE CONSTRAINT_SCHEMA = ? AND TABLE_NAME = ? AND REFERENCED_TABLE_NAME IS NOT NULL", [$db, $table]);

        // Get unique relations only
        $uniqueRows = [];
        foreach ($foreignKeys as $object) {
            $key = $object->COLUMN_NAME . $object->REFERENCED_TABLE_NAME . $object->REFERENCED_COLUMN_NAME . $object->TABLE_NAME;
            if (!array_key_exists($key, $uniqueRows)) {
                $uniqueRows[$key] = $object;
            }
        }

        foreach ($uniqueRows as $foreignKey) {
            $referencedTable = Str::studly($foreignKey->REFERENCED_TABLE_NAME);
            $columnName = $foreignKey->COLUMN_NAME;
            $REFERENCEDCOLUMNNAME = $foreignKey->REFERENCED_COLUMN_NAME;

            // get full namespace for referenced table if table is in other database
            if($foreignKey->REFERENCED_TABLE_SCHEMA != $foreignKey->CONSTRAINT_SCHEMA){
                $referencedTable2 = "\\App\\Models\\".$this->generateModelName($foreignKey->REFERENCED_TABLE_SCHEMA, $referencedTable);
            }else{
                $referencedTable2 = $referencedTable;
            }

            // check if relation is belongs to or has many
            if (str_ends_with($columnName, '_id')) {
                // check if relation is belongs to or has many
                $referenceOccoreds = DB::select(
                    "SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
                    FROM information_schema.key_column_usage
                    WHERE CONSTRAINT_SCHEMA = ? AND TABLE_NAME = ? AND REFERENCED_TABLE_NAME IS NOT NULL",
                    [$db, $table]
                );
                if ($referenceOccoreds > 1) {
                    $methodName = Str::camel(Str::singular(str_replace('_id', '', $columnName)));
                    $relationships[] = "\n\tpublic function $methodName(){return \$this->belongsTo($referencedTable2::class, '$columnName', '$REFERENCEDCOLUMNNAME');}\n";
                } else {
                    $methodName = Str::camel(Str::singular($referencedTable));
                    $relationships[] = "\n\tpublic function $methodName(){return \$this->belongsTo($referencedTable2::class, '$columnName', '$REFERENCEDCOLUMNNAME');}\n";
                }
            } else {
                $methodName = Str::plural($referencedTable);
                $relationships[] = "\n\tpublic function $methodName(){return \$this->hasMany($referencedTable2::class, '$columnName', '$REFERENCEDCOLUMNNAME');}\n";
            }
        }

        return implode('', $relationships);
    }
}
