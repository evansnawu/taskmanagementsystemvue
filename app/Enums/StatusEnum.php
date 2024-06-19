<?php

namespace App\Enums;

enum StatusEnum: string
{
    case Pending = 'Pending';
    case In_Progress = 'In Progress';
    case Completed = 'Completed';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->name] = $case->value;
        }
        return $array;
    }

    public static function toArrayComponent(): array
    {
        $array = [];
        foreach (self::cases() as $index=>$case) {
            $array[] = ['id'=>$case->value,'name'=>$case->value];
        }
        return $array;
    }
}
