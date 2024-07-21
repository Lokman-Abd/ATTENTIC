<?php

namespace App\Console\Commands;


use App\Models\Absence;
use App\Mail\AbsenceEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Notify:email_absence';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send an email to absent students every day';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $absences_info= Absence::getEmailAbsentStudentsToday();

        foreach ($absences_info as $absence_info) {
            Mail::to($absence_info->student_email)->send(new AbsenceEmail($absence_info->student_first_name.' '.$absence_info->student_last_name,$absence_info->short_cut,$absence_info->type,$absence_info->session_date,$absence_info->group_id,$absence_info->teacher_first_name.' '.$absence_info->teacher_last_name,));
        }
        
        return Command::SUCCESS;
    }
}
