<?php
$title = 'Services';
session_start();
include('header.php');
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500;700&display=swap');

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #242836;
    }

    ::-webkit-scrollbar-thumb {
        background: #333541;
    }

    * {

        margin: 0;
        padding: 0;
        box-sizing: border-box;

    }

    body,
    html {

        width: 100%;
        min-height: 100%;
        background-color: #ececec;

    }

    .main-header {

        width: 100%;
        height: 75px;
        background-color: #181A24;
        display: block;

    }

    .main-header ul.header-options {

        width: 100%;
        height: 100%;
        list-style: none;
        display: flex;
        align-items: center;
        justify-content: space-around;
        padding-right: 100px;

    }

    .main-header ul.header-options li {
        display: inline-block;
    }

    .main-header ul.header-options li.title {

        font-size: 18px;
        color: #fff;
        font-family: Arial;
        cursor: pointer;

    }

    .header-mobile {

        width: 100%;
        height: 75px;
        background-color: #181A24;
        text-align: center;
        display: none;
    }

    .title-mobile {
        font-size: 18px;
        color: #fff;
        font-family: Arial;
        cursor: pointer;
        padding-top: 30px;
    }

    a {
        /* text-decoration: none;
        font-size: 16px;
        color: #6D6F79;
        font-family: Arial;
        cursor: pointer; */
    }

    a:hover {
        /* font-size: 16px; */
        /* color: #9598a7; */
    }


    .card {
        margin-top: 100px;
        margin-bottom: 100px;
        height: 1950px;
        width: 1200px;
        border-radius: 30px;
        background-color: #333541;
        margin-left: auto;
        margin-right: auto;
    }

    .card .primary-heading {
        text-align: center;
        font-family: josefin sans;
        color: white;
        padding-top: 50px;
        font-size: 4em;
    }

    .paragraph {
        font-family: josefin sans;
        color: rgb(179, 179, 179);
        margin-left: 50px;
        margin-right: 25px;
        padding-top: 50px;
        font-size: 1.5em;
        line-height: 1.3em;
        font-weight: 500;
    }

    .bold {
        font-weight: 700;
        color: white;
    }

    .footer-heading {
        text-align: center;
        font-family: josefin sans;
        color: white;
        margin-bottom: 50px;
        font-size: 2em;
        line-height: 35px;
    }

    @media only screen and (max-width: 1218px) {
        .card {
            margin-top: 100px;
            margin-bottom: 100px;
            height: 2050px;
            width: 1000px;
            border-radius: 30px;
            background-color: #333541;
            margin-left: auto;
            margin-right: auto;
        }
    }

    @media only screen and (max-width: 1012px) {
        .card {
            margin-top: 100px;
            margin-bottom: 100px;
            height: 2350px;
            width: 800px;
            border-radius: 30px;
            background-color: #333541;
            margin-left: auto;
            margin-right: auto;
        }
    }

    @media only screen and (max-width: 832px) {
        .card {
            margin-top: 100px;
            margin-bottom: 100px;
            height: 2950px;
            width: 600px;
            border-radius: 30px;
            background-color: #333541;
            margin-left: auto;
            margin-right: auto;
        }

        .card .primary-heading {
            font-size: 3.5em;
        }

        .footer-heading {
            font-size: 1.5em;
        }
    }

    @media only screen and (max-width: 626px) {
        .card {
            margin-top: 100px;
            margin-bottom: 100px;
            height: 3850px;
            width: 450px;
            border-radius: 30px;
            background-color: #333541;
            margin-left: auto;
            margin-right: auto;
        }

        .header-mobile {
            display: block;
        }

        .main-header {
            display: none;
        }

        .card .primary-heading {
            font-size: 3em;
        }
    }

    @media only screen and (max-width: 480px) {
        .card {
            margin-top: 100px;
            margin-bottom: 100px;
            height: 5050px;
            width: 350px;
            border-radius: 30px;
            background-color: #333541;
            margin-left: auto;
            margin-right: auto;
        }

        .card .primary-heading {
            font-size: 2em;
        }
    }

    @media only screen and (max-width: 365px) {
        .card {
            margin-top: 100px;
            margin-bottom: 100px;
            height: 6300px;
            width: 290px;
            border-radius: 30px;
            background-color: #333541;
            margin-left: auto;
            margin-right: auto;
        }

        .card .primary-heading {
            font-size: 2em;
        }
    }
</style>

<main>
    <section id="terms-of-service">
        <div class="card">
            <h1 class="primary-heading">Terms of Service</h1>
            <p class="paragraph">
                1) In consideration of your use of the beCoditive API, you represent that you <span class="bold">are</span> of legal age to form a binding contract and are <span class="bold">not</span> a person barred from receiving services under the laws of the Indian Constitution or other applicable jurisdiction. You also agree to: <br> <br>
                • provide true, accurate, current and complete information about yourself as prompted by beCoditive API's registration form and; <br> <br>
                • maintain and promptly update the Registration Data to keep it true, accurate, current and complete. If you provide any information that is untrue, inaccurate, not current or incomplete, or beCoditive has reasonable grounds to suspect that such information is untrue, inaccurate, not current or incomplete, beCoditive has the right to suspend or terminate your account and refuse any and all current or future use of the beCoditive API (or any portion thereof).
                <br><br><br>
                2) Any kind of abusing, harassment using beCoditive API is <span class="bold">strictly prohibited</span>. If anyone is found conducting such acts, they will be <span class="bold">banned</span> from the beCoditive API and legal action will be taken against them.
                <br><br><br>
                3) beCoditive API provides <span class="bold">ONE</span> API key to each person. Trying to generate fakes API keys is strictly <span class="bold">prohibited</span> and this act will result in <span class="bold">banning</span> of the person.
                <br><br><br>
                4) beCoditive API is <span class="bold">copyrighted</span> and if any acts of <span class="bold">plagiarism</span> are discovered, legal action will be taken against the offender.
                <br><br><br>
                5) Flooding beCoditive API with false requests and false complains is <span class="bold">strictly prohibited</span>
                <br><br><br>
                6) Registration Data and certain other information about you <span class="bold">is subject</span> to our Privacy Policy.
                <br><br><br>
                7) You <span class="bold">agree</span> that beCoditive may <span class="bold">terminate</span> your access to beCoditive API for violations of the TOS and/or requests by authorized law enforcement or other government agencies.
            </p>
        </div>
    </section>
</main>

<?php
include('footer.php');
?>