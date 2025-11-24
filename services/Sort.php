<?php

class Sort
{
    public static function nextOrder(string $column, string $sort, string $order): string
    {
        return $column === $sort ? ($order === 'asc' ? 'desc' : 'asc') : 'asc';
    }

    public static function sortArrow(string $column, string $sort, string $order): string
    {
        // flèche pour colonne non triée
        if ($column !== $sort) {
            return '⇅';
        }

        // flèche selon ordre
        return $order === 'asc' ? '↑' : '↓';
    }
}