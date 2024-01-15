<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class ContactController extends SiteController
{
    public function __construct(){
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));

        $this->bar = 'left';
        $this->template = env('THEME') . '.contact';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request->isMethod('post')){
        	
        	$this->validate($request, [
        		'name' => 'required|max:255',
        		'email' => 'required|email',
        		'message' => 'required',
        	]);

        	$data = $request->all();

        	$result = Mail::send(env('THEME') . '.email', ['data' => $data], function($message) use ($data) {

        		$mail_admin = env('MAIL_ADMIN');
                $message->from($data['email'], $data['name']);
                $message->to($mail_admin)->subject('Question');
        	});

        	if($result){
                return redirect()->route('contact')
                                ->with('status', 'Email is send');
            }
        }

        $this->keywords = 'Contact';
        $this->meta_desc = 'Contact';
        $this->title = 'Contact';

        $content = view(env('THEME') . '.contact_content')
                        ->render();

        $this->vars = array_add($this->vars, 'content', $content);

        // SIDEBAR        
        $this->contentLeftBar = view(env('THEME') . '.contactBar')
                                    ->render();

        return $this->renderOutput();
    }
}
