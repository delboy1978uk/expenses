<?php

namespace Del\Expenses\Value;

use Del\Common\Value\ValueInterface;
use InvalidArgumentException;

class Category implements ValueInterface
{

    const INCOME_CASH_JOB ='cash';
    const INCOME_INVOICE = 'invoice';
    const INCOME_LOAN_REPAYMENT = 'loanpayback';
    const INCOME_REBATE = 'rebate';

    const EXPENSE_ACCOMMODATION = 'accommodation';
    const EXPENSE_ACCOUNTANCY = 'accountancy';
    const EXPENSE_BILL = 'bill';
    const EXPENSE_EQUIPMENT = 'equipment';
    const EXPENSE_EQUPIMENT_HIRE = 'hire';
    const EXPENSE_FOOD = 'food';
    const EXPENSE_FUEL = 'fuel';
    const EXPENSE_GENERAL = 'general';
    const EXPENSE_INSURANCE = 'insurance';
    const EXPENSE_IT = 'it';
    const EXPENSE_LOAN = 'loan';
    const EXPENSE_MISC = 'misc';
    const EXPENSE_PERSONAL = 'personal';
    const EXPENSE_RENT = 'rent';
    const EXPENSE_REPAIRS = 'repairs';
    const EXPENSE_SERVICES = 'services';
    const EXPENSE_SUPPLIES = 'supplies';
    const EXPENSE_TAX = 'tax';
    const EXPENSE_TRAINING = 'training';
    const EXPENSE_TRANSPORT = 'transport';
    const EXPENSE_WAGES = 'wages';

    private $acceptableValues = [
        self::INCOME_CASH_JOB, self::INCOME_INVOICE, self::INCOME_LOAN_REPAYMENT, self::EXPENSE_ACCOMMODATION,
        self::EXPENSE_ACCOUNTANCY, self::EXPENSE_BILL, self::EXPENSE_EQUIPMENT, self::EXPENSE_EQUPIMENT_HIRE,
        self::EXPENSE_FOOD, self::EXPENSE_FUEL, self::EXPENSE_GENERAL, self::EXPENSE_IT, self::EXPENSE_INSURANCE,
        self::EXPENSE_LOAN, self::EXPENSE_MISC, self::EXPENSE_PERSONAL, self::EXPENSE_RENT, self::EXPENSE_REPAIRS,
        self::EXPENSE_SERVICES, self::EXPENSE_SUPPLIES, self::EXPENSE_TAX, self::EXPENSE_TRANSPORT, self::EXPENSE_WAGES
    ];

    /** @var string $value */
    private $value;

    /**
     * ValueInterface constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        if (!in_array($value, $this->acceptableValues)) {
            throw new InvalidArgumentException('Not an acceptable value.');
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }


}