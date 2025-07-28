<style>
    .container {
        width: 600px;
        margin: 0 auto;
        border: 1px solid #ddd;
        padding: 20px;
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
    }

    .header,
    .footer {
        text-align: center;
    }

    .header img,
    .footer img {
        max-width: 100%;
    }

    .details-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .details-table th,
    .details-table td {
        padding: 10px;
        border: 1px solid #fff;
    }

    .details-table th {
        background-color: #007BFF;
        color: #fff;
        text-align: left;
    }

    .details-table td {
        background-color: #e9ecef;
    }
</style>

<style>
    @font-face {
        font-family: 'Avenir Next LT Pro Light';
        src: url('/fonts/AvenirLTProLight.woff') format('woff');
        font-weight: 300;
        font-style: normal;
    }
</style>

<div class="container" style="width: 600px; margin: 0 auto; border: 1px solid #ddd; padding: 5px; font-family: 'Avenir Next LT Pro Light', Arial, sans-serif; background-color: #f9f9f9;">
    <div class="header" style="text-align: center;">
        <img src="https://bluelotusvacations.uk/images/header_new_email.jpg" alt="Email Header" style="max-width: 100%;">
    </div>

    <p style="font-weight: bold;">Dear {{ $details['name'] }},</p>

    <p style="font-weight: bold;">Our team will assess your General Inquiry request and provide you with detailed information and personalized quotes shortly.</p>

    <table class="details-table" style="width: 70%; border-collapse: collapse; margin-top: 5px; margin-left: auto; margin-right: auto;">
        <tr>
            <th style="padding: 5px; border: 1px solid #fff; background-color: #007BFF; color: #fff; text-align: left;">Name:</th>
            <td style="padding: 5px; border: 1px solid #fff; background-color: #e9ecef;">{{ $details['name'] }}</td>
        </tr>
        <tr>
            <th style="padding: 5px; border: 1px solid #fff; background-color: #007BFF; color: #fff; text-align: left;">Email:</th>
            <td style="padding: 5px; border: 1px solid #fff; background-color: #e9ecef;">{{ $details['email'] }}</td>
        </tr>
        <tr>
            <th style="padding: 5px; border: 1px solid #fff; background-color: #007BFF; color: #fff; text-align: left;">Phone Number:</th>
            <td style="padding: 5px; border: 1px solid #fff; background-color: #e9ecef;">{{ $details['mobile'] }}</td>
        </tr>

        <tr>
            <th style="padding: 5px; border: 1px solid #fff; background-color: #007BFF; color: #fff; text-align: left;">Special Remark:</th>
            <td style="padding: 5px; border: 1px solid #fff; background-color: #e9ecef;">{{ $details['message'] }}</td>
        </tr>
    </table>

    <div class="footer" style="text-align: center;">
        <img src="https://bluelotusvacations.uk/images/footer_new_email.png" alt="Email Footer" style="max-width: 100%;">
    </div>
</div>