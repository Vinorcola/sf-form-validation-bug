<?php

namespace App\FormDTO;

use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class MappingDTO
{
    /**
     * @var ObjectMappingDTO[]
     */
    public $contextMapping = [];

    /**
     * @var ObjectMappingDTO[]
     */
    public $filterMapping = [];

    /**
     * @Constraints\Callback()
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        // VALIDATION MAPPING BUG QUICK FIX START ----------------------
        $context->setNode(
            $context->getValue(),
            $context->getObject(),
            $context->getMetadata(),
            ''
        );
        // VALIDATION MAPPING BUG QUICK FIX END ------------------------

        $usedColumns = [];
        foreach ($this->contextMapping as $contextId => $dto) {
            if ($dto->columnName && key_exists($dto->columnName, $usedColumns)) {
                $context
                    ->buildViolation(
                        'The column "' . $dto->columnName . '" is already used for ' .
                        $usedColumns[$dto->columnName]['type'] . ' "' .
                        $usedColumns[$dto->columnName]['title'] . '".'
                    )
                    ->atPath('children[contextMapping].children[' . $contextId . '].children[columnName]')
                    ->addViolation();
            } else {
                $usedColumns[$dto->columnName] = [
                    'type'  => 'context',
                    'title' => $dto->title,
                ];
            }
        }
        foreach ($this->filterMapping as $filterId => $dto) {
            if ($dto->columnName && key_exists($dto->columnName, $usedColumns)) {
                $context
                    ->buildViolation(
                        'The column "' . $dto->columnName . '" is already used for ' .
                        $usedColumns[$dto->columnName]['type'] . ' ' .
                        $usedColumns[$dto->columnName]['title'] . '.'
                    )
                    ->atPath('children[filterMapping].children[' . $filterId . '].children[columnName]')
                    ->addViolation();
            } else {
                $usedColumns[$dto->columnName] = [
                    'type'  => 'filter',
                    'title' => $dto->title,
                ];
            }
        }
    }
}
