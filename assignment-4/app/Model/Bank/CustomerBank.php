<?php

namespace App\Model\Bank;

use App\Model\Account;
use App\Transaction\DepositTransaction;
use App\Transaction\Transaction;
use App\Transaction\WithdrawTransaction;
use App\User\User;
use App\Contract\Storage;
use App\Enum\UserRole;
use App\Responses\ErrorResponse;
use App\Responses\Response;
use App\Responses\SuccessResponse;

class CustomerBank extends Bank
{    
    public function __construct(Storage $storage) {
        $this->account = new Account($storage);
        parent::__construct($storage);
    }

    public function transactions(User $user): Response|array
    {
        if(!$this->isExistTransaction($user->getEmail())) {
            return new ErrorResponse("**Transaction doesn't not exist!");
        }    
        
        return $this->getUserTransactions($user->getEmail());
    }

    public function deposit(User $user, float $amount): Response
    {
        if($amount <= 0) {
            return new ErrorResponse("**Amount cannot be 0!");
        } 

        $deposit = new DepositTransaction($user, $amount);
        $this->setTransactions($deposit);
        $this->saveTransaction(Transaction::getModelName());
        
        return new SuccessResponse("Deposit balance successful");
    }

    public function withdraw(User $user, float $amount): Response
    {
        if($amount <= 0) {
            return new ErrorResponse("**Amount cannot be 0!");
        }

        if($this->getBalance($user) < $amount) {
            return new ErrorResponse("**Sorry currently you have " . $this->getBalance($user));
        }

        if(!$this->isExistTransaction($user->getEmail())) {
            return new ErrorResponse("**Transaction doesn't not exist!");
        } 
        
        $withdraw = new WithdrawTransaction($user, $amount);
        $this->setTransactions($withdraw);
        $this->saveTransaction(Transaction::getModelName());

        return new SuccessResponse("Withdraw balance successful");
    }

    public function getBalance(User $user): float
    {
        $savings = 0;
        foreach($this->getTransactions() as $transaction) {
            if($transaction->getUser()->getEmail() === $user->getEmail()) {
                if($this->isDepositOrReceived($transaction)) {
                    $savings += $transaction->getAmount();
                } else if($this->isWithdrawOrTransferred($transaction)) {
                    $savings -= $transaction->getAmount();
                }
            }
        }

        return $savings;
    }

    public function transfer(User $user, string $toEmail, float $toAmount): Response
    {
        if($toAmount <= 0) {
            return new ErrorResponse("**Amount cannot be 0!");
        }

        if(!$this->isExistTransaction($user->getEmail())) {
            return new ErrorResponse("**Transaction doesn't not exist!");
        } 

        if($user->getEmail() === $toEmail) {
            return new ErrorResponse("**Try with other existing email!");  
        }
        
        if(is_null($this->getExistingUser($toEmail))) {
            return new ErrorResponse("**Email do not exist!");  
        } 

        if($this->getExistingUser($toEmail)->getRole() === UserRole::ADMIN) {
            return new ErrorResponse("**You should transfer to a customer!");  
        } 

        if($this->getBalance($user) < $toAmount) {
            return new ErrorResponse("**Sorry currently you have " . $this->getBalance($user));
        }

        $response = $this->transferMoney($user, $toAmount);
        if($response instanceof ErrorResponse) {
            return $response;
        }

        $this->receiveMoney($this->getExistingUser($toEmail), $toAmount);
        return new SuccessResponse("Transfered succussfully");
    }
}