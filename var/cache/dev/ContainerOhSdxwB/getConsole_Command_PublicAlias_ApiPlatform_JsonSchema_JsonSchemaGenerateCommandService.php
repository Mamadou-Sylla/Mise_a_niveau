<?php

namespace ContainerOhSdxwB;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getConsole_Command_PublicAlias_ApiPlatform_JsonSchema_JsonSchemaGenerateCommandService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'console.command.public_alias.api_platform.json_schema.json_schema_generate_command' shared service.
     *
     * @return \ApiPlatform\Core\JsonSchema\Command\JsonSchemaGenerateCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/JsonSchema/Command/JsonSchemaGenerateCommand.php';

        return $container->services['console.command.public_alias.api_platform.json_schema.json_schema_generate_command'] = new \ApiPlatform\Core\JsonSchema\Command\JsonSchemaGenerateCommand(($container->privates['api_platform.hydra.json_schema.schema_factory'] ?? $container->getApiPlatform_Hydra_JsonSchema_SchemaFactoryService()), $container->parameters['api_platform.formats']);
    }
}
