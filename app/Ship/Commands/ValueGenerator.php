<?php


namespace App\Ship\Commands;


use Apiato\Core\Generator\GeneratorCommand;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class ValueGenerator extends GeneratorCommand implements ComponentsGenerator
{

    public array $inputs = [
    ];


    protected $name = 'apiato:generate:value';

    protected string $fileType = 'Value';

    protected string $pathStructure = '{section-name}/{container-name}/Values/*';

    protected string $nameStructure = '{file-name}';

    protected string $stubName = 'value.stub';

    public function getUserInputs(): ?array
    {
        return [
            'path-parameters' => [
                'section-name' => $this->sectionName,
                'container-name' => $this->containerName,
            ],
            'stub-parameters' => [
                '_section-name' => Str::lower($this->sectionName),
                'section-name' => $this->sectionName,
                '_container-name' => Str::lower($this->containerName),
                'container-name' => $this->containerName,
                'class-name' => $this->fileName,
            ],
            'file-parameters' => [
                'file-name' => $this->fileName,
            ],
        ];
    }

}
