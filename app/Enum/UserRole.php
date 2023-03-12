<?php

namespace App\Enum;

enum UserRole: string {
    case MarketingAgent = 'marketing_agent';
    case Manager = 'manager';
}