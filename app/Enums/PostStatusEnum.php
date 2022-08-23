<?php

namespace App\Enums;

enum PostStatusEnum:string {
    case DRAFT = 'DRAFT';
    case PUBLISHED = 'PUBLISHED';
    case TRASHED = 'TRASHED';
}