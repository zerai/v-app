<?php declare(strict_types=1);

namespace ClinicManagement\Infrastructure\Doctrine\Lib;

/**
 * @template T of object
 *
 * @extends \IteratorAggregate<array-key, T>
 */
interface PaginatorInterface extends \IteratorAggregate, \Countable
{
    public function getCurrentPage(): int;

    public function getItemsPerPage(): int;

    public function getLastPage(): int;

    public function getTotalItems(): int;
}
