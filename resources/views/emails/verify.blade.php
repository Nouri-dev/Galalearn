<!-- resources/views/emails/verify.blade.php -->

<p>Bonjour {{ $user->firstname }},</p>

<p>Cliquez sur le lien ci-dessous pour vérifier votre adresse e-mail :</p>

<a href="{{ route('verify.email', ['token' => $token, 'email' => $user->email]) }}">
    Vérifier mon adresse e-mail
</a>

<p>Merci de vous être inscrit sur notre site !</p>
