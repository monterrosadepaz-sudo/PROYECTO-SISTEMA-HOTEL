<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index()
    {
        $roomsCount     = Room::count();
        $bookingsCount  = Booking::count();
        $customersCount = Customer::count();
        $invoicesCount  = Invoice::count();

        return view('admin.dashboard', compact(
            'roomsCount',
            'bookingsCount',
            'customersCount',
            'invoicesCount'
        ));
    }
}
