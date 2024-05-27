<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmiDetailsService;

class EmiDetailsController extends Controller
{
    protected $emiDetailsService;

    public function __construct(EmiDetailsService $emiDetailsService){
        $this->emiDetailsService = $emiDetailsService;
    }

    public function index()
    {
        return view('emi-details.index');
    }

    public function process()
    {
        $createEmiDetailsTable = $this->emiDetailsService->createEmiDetailsTable();
        
        if($createEmiDetailsTable){
            $calculateEmi = $this->emiDetailsService->calculateEmiDetails();

            if($calculateEmi){
                return redirect()->route('emi-details.index')->with('success', 'Emi details processed successfully');
            }else{
                return redirect()->route('emi-details.index')->with('success', 'Something is wrong please try again');
            }
        }else{
            return redirect()->route('emi-details.index')->with('success', 'Something is wrong please try again');
        }
        

        
    }
}
