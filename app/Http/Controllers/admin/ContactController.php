<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function index()
    {
        $pageTitle = 'Contact'; 
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Contacts',
                'url' => null
            ],
        ];
    
        // Retrieve contacts in descending order by 'created_at'
        $contacts = Contact::orderBy('created_at', 'desc')->get();
    
        return view('admin.contact.index', compact('contacts', 'pageTitle', 'breadcrumbs'));
    }
    

}
