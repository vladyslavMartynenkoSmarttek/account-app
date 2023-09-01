<?php

    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Mail\Mailable;
    use Illuminate\Mail\Mailables\Content;
    use Illuminate\Mail\Mailables\Envelope;
    use Illuminate\Queue\SerializesModels;

    class TestHelloEmail extends Mailable
    {
        use Queueable, SerializesModels;

        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct()
        {
            //
        }

        /**
         * Get the message envelope.
         *
         * @return Envelope
         */
        public function envelope(): Envelope
        {
            return new Envelope(
                subject: 'Test Hello Email',
            );
        }

        /**
         * Get the message content definition.
         *
         * @return Content
         */
        public function content(): Content
        {
            return new Content(
                view: 'view.mail.testEmails',
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
