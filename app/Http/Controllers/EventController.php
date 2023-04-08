<?php

namespace App\Http\Controllers;

use App\Models\Event;
class EventController extends Controller{

    /**
     * Show the events page //TODO: check naming conventions
     */
    public function list(){
        $events = Event::where('requeststatus', 'Accepted')
                       ->get();//TODO:Decide what to to with cancelled events
        return view('pages.events', ['events' => $events]);
    }

    // Show the event page
    public function show($eventId){   
        $event= Event::find($eventId);
        return view('pages.event',['event' => $event]);
    }

    public function adminDashboardEvents(){
        $pendingEvents = Event::where('requeststatus', 'Pending')
                              ->limit(10)
                              ->get();
        $events = Event::whereNotIn('requeststatus', ['Pending'])
                        ->limit(10)
                        ->get();
        return view('pages.admin', ['events' => $events,'pendingEvents' => $pendingEvents]);
    }

    //Accepts/Rejects event
    public function updateStatus($id, $status) {//TODO: Change so only authorized users can make use of this
        $event = Event::find($id);
        $event->requeststatus = $status;
        $event->datereviewed = now()->format('Y-m-d');
        $event->save();
    
        return redirect()->back()->with('success', 'Event status updated successfully.');
    }

}
