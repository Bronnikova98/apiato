<?php


namespace App\Ship\Commands;


use Apiato\Core\Generator\GeneratorCommand;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class ManagerGenerator extends GeneratorCommand implements ComponentsGenerator
{

    public array $inputs = [
        ['section', null, InputOption::VALUE_OPTIONAL, 'The name of the section'],
        ['file', null, InputOption::VALUE_OPTIONAL, 'The name of the file']
    ];


    protected $name = 'apiato:generate:manager';

    protected string $fileType = 'Manager';

    protected string $pathStructure = '{section-name}/Managers/*';

    protected string $nameStructure = '{file-name}';

    protected string $stubName = 'manager.stub';

    public function getUserInputs(): ?array
    {
        return [
            'path-parameters' => [
                'section-name' => $this->sectionName,
            ],
            'stub-parameters' => [
                '_section-name' => Str::lower($this->sectionName),
                'section-name' => $this->sectionName,
                'class-name' => $this->fileName,
            ],
            'file-parameters' => [
                'file-name' => $this->fileName,
            ],
        ];
    }

}
