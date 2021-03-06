<?php

namespace App\Http\Controllers;

use Storage;
use App\Note;
use App\Mail\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewPagesController extends Controller
{
  
  /**
   * Main page
   * @return void
   */
  public function index()
  {
    $note = Note::all();
    return view('index',
    [
      'active_page' => 'home',
      'notes' => $note
    ]);
  }
  
  /**
   * Resume page
   * @return void
   */
  public function resume()
  {
    return view('resume',
    [
      'active_page' => 'resume',
      'title' => 'Steven Liao Resume'
    ]);
  }
  
  /**
   * Projects page
   * @return void
   */
  public function projects()
  {
    $projectsContents = file_get_contents('files/json/projects.json');
//     var_dump($projectsContents);
    $projects = json_decode($projectsContents);
//     var_dump($projects);
    return view('projects',
    [
      'active_page' => 'projects',
      'title' => 'Steven Liao Projects',
      'projects' => $projects,
      'extscripts' => ['js/projects.js']
    ]);
  }
  
  /**
   * Contact page
   * @return void
   */
  public function contact()
  {
    return view('contact',
    [
      'active_page' => 'contact',
      'title' => 'Contact Me'
    ]);
  }
  
  /**
   * Send email from contact page with post method.
   * @param request
   * @return void
   */
  public function sendEmail(Request $request)
  {
    if ($request->isMethod('post'))
    {
      $emailContent = new \stdClass();
      $emailContent->name = $request->name;
      $emailContent->emailAddress = $request->emailAddress;
      $emailContent->subject = $request->subject;
      $emailContent->files = $request->file('files');
      $emailContent->message = $request->message;
      
      if ($request->emailAddress && $request->name)
      {
        Mail::to('Stvnliao@yahoo.com')
            ->send(new Email($emailContent));
      }
      
      return view('email_sent',
      [
        'active_page' => 'email_sent',
        'emailContent' => $emailContent
      ]);
    }
  }
}
