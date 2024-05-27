<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\LoanDetail;
use DateTime;

class EmiDetailsService{
    public function createEmiDetailsTable(){
        try{
            // Drop the table if it exists
            DB::statement('DROP TABLE IF EXISTS emi_details');

            // Get min first_payment_date and max last_payment_date
            $minDate = LoanDetail::min('first_payment_date');
            $maxDate = LoanDetail::max('last_payment_date');

            // Create the emi_details table with dynamic columns
            $dates = $this->generateMonthsArray($minDate, $maxDate);
            $columns = implode(', ', array_map(function ($date) {
                return "`{$date}` DECIMAL(7,2) DEFAULT 0";
            }, $dates));
            
            $query = "CREATE TABLE emi_details (clientid INT, $columns)";
            DB::statement($query);

            return true;
        }catch(\Exception $e){
            Log::info($e);
            return false;
        }
        
    }


    public function calculateEmiDetails(){
        // Process each row in loan_details
        $loanDetails = LoanDetail::get();

        foreach ($loanDetails as $loanDetail) {
            $clientid = $loanDetail->clientid;
            $loanAmount = $loanDetail->loan_amount;
            $numOfPayment = $loanDetail->num_of_payment;

            // Calculate EMI amount
            $emiAmount = $loanAmount / $numOfPayment;

            // Insert EMI amount into emi_details table for each month
            $currentDate = new DateTime($loanDetail->first_payment_date);
            $lastPaymentDate = new DateTime($loanDetail->last_payment_date);

            while ($currentDate <= $lastPaymentDate) {
                $month = $currentDate->format('Y_M');

                DB::beginTransaction();
                try {
                    DB::table('emi_details')->updateOrInsert(
                        ['clientid' => $clientid],
                        [$month => $emiAmount]
                    );
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                }
                // Insert EMI amount into emi_details table


                // Move to the next month
                $currentDate->modify('+1 month');
            }
        }

        return true;
    }

    private function generateMonthsArray($start, $end)
    {
        $start = new \DateTime($start);
        $end = new \DateTime($end);
        $months = [];
        while ($start <= $end) {
            $months[] = $start->format('Y_M');
            $start->modify('+1 month');
        }
        return $months;
    }
}