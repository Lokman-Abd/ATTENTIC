<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AbsenceEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $student_name;
    public $module;
    public $type;
    public $date;
    public $group;
    public $teacher;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $student_name,
        $module,
        $type,
        $date,
        $group,
        $teacher
    ) {
        $this->$student_name=$student_name;
        $this->module = $module;
        $this->type = $type;
        $this->date = $date;
        $this->group = $group;
        $this->teacher = $teacher;
    }
    public function envelope()
    {
        return new Envelope(
            subject: 'Absence',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'absence_template',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
