<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnquiryRequest;
use App\Http\Requests\UpdateEnquiryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use SendGrid\Mail\Mail;
use SendGrid;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function enquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required',
            'message' => 'required|string',
        ]);

        Log::info('New enquiry submitted:', $validated);

        // Prepare SendGrid email
        $email = new Mail();
        $email->setFrom(env('MAIL_FROM_ADDRESS'), "Ceylon Voyages");
        $email->setSubject("Thank You For Your Inquiry");
        $email->addTo(env('MAIL_TO_ADDRESS'), "Ceylon Voyages");

        $htmlContent = view('emails.contactusPageForm', ['details' => $validated])->render();
        $email->addContent("text/html", $htmlContent);

        // Send email with SendGrid
        $sendgrid = new SendGrid(env('MAIL_PASSWORD'));


        try {
            $response = $sendgrid->send($email);

            if ($response->statusCode() >= 200 && $response->statusCode() < 300) {
                Enquiry::create($validated); // Save to DB only if email sent successfully
                return response()->json(['message' => 'Enquiry submitted successfully.'], 200);
            } else {
                Log::error('SendGrid failed to send email.', [
                    'status' => $response->statusCode(),
                    'body' => $response->body()
                ]);
                return response()->json(['message' => 'Failed to send enquiry email.'], 500);
            }
        } catch (\Exception $e) {
            Log::error('SendGrid exception:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'An error occurred while sending your enquiry.'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnquiryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnquiryRequest $request, Enquiry $enquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enquiry $enquiry)
    {
        //
    }
}
