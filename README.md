# Expenses
[![Build Status](https://travis-ci.org/delboy1978uk/expenses.png?branch=master)](https://travis-ci.org/delboy1978uk/expenses) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/expenses/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/expenses/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/expenses/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/expenses/?branch=master) <br />
A simple service for storing money in, money out, and expense claims.
##Installation
Install the package using composer:
```
composer require delboy1978uk/expenses
```
###Database Setup
Create a migrant-cfg.php based on vendor/delboy1978uk/common/migrant-cfg.php.dist and add delboy1978uk/expenses in the
packages section.
Then run:
```
migrant migrate
```
###Common Package Registration
Expenses works with delboy1978uk/common, which has a Doctrine Entity Manager and a Pimple DIC. Register with the 
Del\Expenses\ExpensesPackage to the container.
```php
use Del\Common\ContainerService;
use Del\Expenses\ExpensesPackage;

$package = new ExpensesPackage();
ContainerService::getInstance()->registerToContainer($package);
```
##The Expenses Service
```php
$container = ContainerService::getInstance()->getContainer();
$svc = $container['service.expenses'];
```
###Service Methods
```php
$svc->createIncomeFromArray($data);
$svc->createExpenditureFromArray($data);
$svc->createExpenseClaimFromArray($data);
$svc->toArray($entity);
$svc->saveIncome($entity);
$svc->saveExpenditure($entity);
$svc->saveExpenseClaim($entity);
$svc->deleteIncome($entity);
$svc->deleteExpenditure($entity);
$svc->deleteExpenseClaim($entity);
$svc->deleteEntry($entity);
$svc->findByCriteria($criteria);
$svc->findIncomeById($id);
$svc->findExpenditureById($id);
$svc->findExpenseClaimById($id);
$svc->findExpenseClaimById($id);
$svc->saveIncome($income);
$svc->saveExpenditure($expenditure);
$svc->saveExpenseClaim($claim);
```
##Entities
There are three types of entity, which all extend abstract class Entry, Income, Expenditure, and Expense Claim. 
Income and Expenditure are enough for a sole trader, someone with a limited company can use a ExpenseClaim entity to
make an Expenditure that came out your own pocket that you can claim back from the business. All in order to figure out
your taxable pay. An EntryInterface has the following methods:
```php
$entity->getId();
$entity->getUserId();
$entity->getDate();
$entity->getAmount();
$entity->getDescription();
$entity->getNote();
$entity->getCategory();
$entity->getType();
```
##Criteria
Searching the DB is simple using a Criteria object:
```php
use Del\Expenses\Criteria\EntryCriteria;

$criteria = new Criteria();
$criteria->setUserId(42);
$criteria->setType('IN'); // also OUT or CLAIM
$criteria->setOrder(Criteria::ORDER_DATE);
$criteria->setLimit(25);
$criteria->setOffset(74);

$results = $svc->findByCriteria($criteria);
```