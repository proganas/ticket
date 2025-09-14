<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\UserAssignedNotification;

class TicketController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $tickets = Ticket::paginate(10);
        } elseif (auth()->user()->role == 'agent') {
            $tickets = Ticket::where('created_by', auth()->id())->orWhere('assigned_to', auth()->id())->orWhere('assigned_to', null)->paginate(10);
        } else {
            $tickets = Ticket::where('created_by', auth()->id())->orWhere('assigned_to', auth()->id())->paginate(10);
        }

        return view('tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            if ($ticket->created_by != auth()->id() && $ticket->assigned_to != auth()->id() && auth()->user()->role != 'admin' && $ticket->assigned_to != null) {
                $prefix = request()->segment(1);
                return redirect()->route($prefix . '.tickets.index')->with('error', 'You are not authorized to view this ticket.');
            }
            return view('tickets.show', compact('ticket'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Something Wrong']);
        }
    }

    public function create()
    {
        try {
            $users = User::where('id', '!=', auth()->id())->get();
            $projects = Project::all();
            return view('tickets.create', compact('users', 'projects'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => 'Something Wrong']);
        }
    }

    public function store(TicketRequest $request)
    {
        try {
            $requested_data = $request->only(['title', 'description', 'priority', 'status', 'assigned_to', 'created_by', 'project_id']);
            $ticket = Ticket::create($requested_data);

            // Notify the user if assigned
            if ($ticket->assigned_to) {
                $user = User::where('id', $ticket->assigned_to)
                    ->first();

                if ($user) {
                    $user->notify(new UserAssignedNotification($ticket));
                }
            }


            $prefix = request()->segment(1);
            return redirect()->route($prefix . ".tickets.index")->with('success', 'Ticket created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['error' => 'Something Wrong']);
        }

    }

    public function edit($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $users = User::where('id', '!=', auth()->id())->get();
            $projects = Project::all();
            return view('tickets.edit', compact('ticket', 'users', 'projects'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Something Wrong']);
        }
    }

    public function update(TicketRequest $request, $id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $requested_data = $request->only(['title', 'description', 'priority', 'status', 'assigned_to', 'created_by', 'project_id']);
            $ticket->update($requested_data);
            $prefix = request()->segment(1);

            return redirect()->route($prefix . ".tickets.index")->with('success', 'Ticket updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['error' => 'Something Wrong']);
        }
    }

    public function destroy($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->delete();

            return redirect()->route("admin.tickets.index")->with('success', 'Ticket deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Something Wrong']);
        }
    }

    public function replay($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            if ((auth()->id() == $ticket->assigned_to || auth()->id() == $ticket->created_by) || (auth()->user()->role == 'agent' && $ticket->assigned_to == null)) {
                return view('tickets.replay', compact('ticket'));
            }
            return redirect()->back()->with(['error' => 'You are not authorized to replay this ticket.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Something Wrong']);
        }
    }

    public function save_replay()
    {
        try {
            $data = request()->validate([
                'ticket_id' => 'required|exists:tickets,id',
                'message' => 'required|string',
            ]);

            $ticket = Ticket::findOrFail($data['ticket_id']);
            if ((auth()->id() == $ticket->assigned_to || auth()->id() == $ticket->created_by) || (auth()->user()->role == 'agent' && $ticket->assigned_to == null)) {

                if ($ticket->assigned_to == null) {
                    $ticket->assigned_to == auth()->id();
                }
                $ticket->message = $data['message'];
                $ticket->status = 'closed';
                $ticket->save();

                $prefix = request()->segment(1);
                return redirect()->route($prefix . '.tickets.show', $ticket->id)->with('success', 'Reply added successfully.');
            }
            return redirect()->back()->with(['error' => 'You are not authorized to replay this ticket.']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['error' => 'Something Wrong']);
        }
    }
}
