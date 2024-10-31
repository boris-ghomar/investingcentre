<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('nova_mail_templates')->insert([
            [
                'name' => 'Invitation',
                'subject' => 'Join Us on Our Investment Platform',
                'content' => '
                <html>
                <head>
                    <style>
                        .banner-color {
                            background-color: #eb681f;
                        }
                        .title-color {
                            color: #0066cc;
                        }
                        .button-color {
                            background-color: #0066cc;
                        }
                        @media screen and (min-width: 500px) {
                            .banner-color {
                                background-color: #0066cc;
                            }
                            .title-color {
                                color: #eb681f;
                            }
                            .button-color {
                                background-color: #eb681f;
                            }
                        }
                    </style>
                </head>
                <body>
                    <div style="background-color:#ececec;padding:0;margin:0 auto;font-weight:200;width:100%!important">
                        <table align="center" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <center style="width:100%">
                                            <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;max-width:512px;font-weight:200;width:inherit;font-family:Helvetica,Arial,sans-serif" width="512">
                                                <tbody>
                                                    <tr>
                                                        <td bgcolor="#F3F3F3" width="100%" style="background-color:#f3f3f3;padding:12px;border-bottom:1px solid #ececec">
                                                            <table border="0" cellspacing="0" cellpadding="0" style="width:100%!important">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="left" valign="middle" width="50%">
                                                                            <span style="color:#4c4c4c;display:inline-block;font-size:12px;line-height:20px">Investment Platform</span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" bgcolor="#8BC34A" class="banner-color" style="padding:20px 48px;color:#ffffff">
                                                            <h1 style="color:#ffffff;font-weight:500;font-size:20px;line-height:24px">You are Invited!</h1>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="padding:20px 0 10px 0">
                                                            <h3 class="title-color" style="font-weight:600;font-size:16px;line-height:24px;text-align:center;">Hello,</h3>
                                                            <p style="margin:20px 0 30px 0;font-size:15px;text-align:center;">
                                                                We are thrilled to invite you to join our exclusive investment platform. Explore tailored investment opportunities and grow your wealth in a supportive community. Spaces are limited, so <b>register today!</b>
                                                            </p>
                                                            <div style="text-align:center;margin:25px;">
                                                                <a href="' . route("customer.register") . '?u={{ $username }}&d={{ $domain }}" style="padding:0.6em 1em;border-radius:600px;color:#ffffff;font-size:14px;text-decoration:none;font-weight:bold" class="button-color">Join Now</a>
                                                           </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="padding:12px 0 20px 0;color:#4c4c4c;font-size:12px;line-height:18px">
                                                            Best regards, <br><b>Betcart Team</b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </body>
                </html>
                ',
                'send_delay_in_minutes' => 0,
            ],
        ]);
    }
}
