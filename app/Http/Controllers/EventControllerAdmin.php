<?php

namespace App\Http\Controllers;


use App\Models\Event;
use App\Models\Formation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class EventControllerAdmin extends AdminController{
  
    public function __construct(){
        parent::__construct();
    }

    /**
     * Show the admin dashboard for events 
     */
    public function show(){
        /*if (!$this->hasRoles()) {
            return redirect()->back()->with('error', 'You are not authorized to view this admin area.');
        }

        if ($this->user->isAdmin()) {*/
            $pendingEvents = Event::where('requeststatus', 'Pending')
                                ->limit(10)
                                ->get();
            $events = Event::whereNotIn('requeststatus', ['Pending'])
                            ->limit(10)
                            ->get();
        /*}else {
            $formations = Formation::where('userid', $this->user->userid)->get();
            if ($formations->isNotEmpty()) {
                // Retrieve an array of organic unit IDs for the user's formation roles
                $organicUnitIds = $formations->pluck('organicunitid')->toArray();
            }

            $pendingEvents = Event::where('requeststatus', 'Pending')
                                ->whereIn('organicunitid', $organicUnitIds)
                                ->limit(10)
                                ->get();
            $events = Event::whereNotIn('requeststatus', ['Pending'])
                            ->whereIn('organicunitid', $organicUnitIds)
                            ->limit(10)
                            ->get();
        }*/
        return view('pages.adminEvents', ['events' => $events,'pendingEvents' => $pendingEvents]);
    }

    //Accepts/Rejects event
    public function updateStatus($id, $status) {//TODO: Change so only authorized users can make use of this and GI only for their respective organic units
        /*if (!$this->hasRoles()) {
            return redirect()->back()->with('error', 'You are not authorized to view this admin area.');
        }*/

        $formations = Formation::where('userid', $this->user->userid)->get();
        
        
        if ($formations->isEmpty()) {
            return redirect()->back()->with('error', 'You are not authorized to update the status of this event.');
        }
        
        if (!$formations->pluck('organicunitid')->contains($event->organicunitid)) {
            return redirect()->back()->with('error', 'You are not authorized to update the status of this event.');
        }
        
        return redirect()->route('login')->with('error', 'You are not authorized to update the status of this event.');
        /*
        $event = Event::find($id);
        $event->requeststatus = $status;
        $event->datereviewed = now()->format('Y-m-d');
        $event->save();*/
    
        return redirect()->back()->with('success', 'Event status updated successfully.');
    }

}
