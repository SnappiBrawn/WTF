<!-- FAQ Page -->
<?php
  session_start();
?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>WTF | FAQ </title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,800" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>
    <body>
        <?php include "utils/styles.php"?>
        <?php include "utils/header.php"?>
        <div class="container faq-container">
            <h1 class="text-center">Frequently Asked Questions</h1>
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="Q1">
                <h2 class="mb-0">
                    <button class="btn" data-toggle="collapse" data-target="#A1" aria-controls="A1">
                    What is WhatToFood?
                    </button>
                </h2>
                </div>

                <div id="A1" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    WhatToFood is a free recipe storehouse that has the ability to cater to your cooking plans based on the ingredients at hand.
                    It's as simple as a click. Just search for an ingredient on the console and add  it to your pantry. 
                    All your recommendations from there on will be based on the contents of your pantry.
                    You can also look around the ingredients section for details about them. This will help you identify them better.
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="Q2">
                <h2 class="mb-0">
                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#A2">
                    What is your source for all these recipes?
                    </button>
                </h2>
                </div>
                <div id="A2" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    Most of our recipes are sourced from around the internet, marked as authored by WTF. Our primary source however, is you!
                    That's right. As users of WTF, you have the ability to submit your own recipes to the site. This will help others look it up.
                    And you will also be given due credit. So feel free to share what you have, be it a quick fix you learnt along college or a family famous recipe.
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="Q3">
                    <h2 class="mb-0">
                        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#A3">
                        How can I contribute?
                        </button>
                    </h2>
                </div>
                <div id="A3" class="collapse" data-parent="#accordionExample">
                    <div class="card-body">
                        Firstly, thank you for considering. The first step to submitting a recipe is to create an account with WTF. 
                        This helps us keep a record of all our users and their submissions, while giving them the credit that they're due.
                        Once you're signed up, head on over to the "Submit a Recipe" page and fill in the form. Click submit, and await a response.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="Q4">
                <h2 class="mb-0">
                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#A4">
                    What happens to my submissions?
                    </button>
                </h2>
                </div>
                <div id="A4" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    WTF has an elaborate submission process to ensure the quality of the content that goes up. Following is a rough description of the process:
                    <ol style="A">
                        <li>Your submission is added to a submission queue, accessible only to the editors here at WTF. During this period, you will be allowed to review and edit your submission.</li>
                        <li>The editors will then go through your submission, review it for duplication or possible errors and queries.</li>
                        <li>Once your submission passes all the check, it'll be approved and moved to the active listings. Here on, you will not be able to make any changes to your recipe.</li>
                    </ol>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="Q5">
                <h2 class="mb-0">
                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#A5">
                    Can I check or edit my submissions?
                    </button>
                </h2>
                </div>
                <div id="A5" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    Yes you can. During the waiting period, the submiter is allowed to review their submissions as many times as they like. 
                    This is to ensure you have autonomy of your recipe and to avoid excessive error correction later on.
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="Q6">
                <h2 class="mb-0">
                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#A6">
                    Why can't I see or edit my submission anymore?
                    </button>
                </h2>
                </div>
                <div id="A6" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    Once a recipe is approved, it is moved to the sites main listings. This will make it public for all the registered and unregisterd users on WTF. 
                    Here on, all edit access of the original submiter will be revoked. This is done in accordance to our content policy to ensure that 
                    no tampering with the site's live content is possible. For the security and integrity of the site, all live content is deemed owned by WTF and will not be allowed to edit by anyone.
                </div>
                </div>
            </div>
            </div>
            <div class="card">
                <div class="card-header" id="Q7">
                <h2 class="mb-0">
                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#A7">
                    Whom should I contact about queries pertaining to the content on WTF?
                    </button>
                </h2>
                </div>
                <div id="A7" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    Our editors are forever active to cater to your queries. You can contact us at <strong>foodislove.wtf@gmail.com</strong> for all your queries regarding issues with content.
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="Q8">
                <h2 class="mb-0">
                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#A8">
                    Whom should I contact about queries pertaining to technical issues on WTF?
                    </button>
                </h2>
                </div>
                <div id="A8" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    Our editors are forever active to cater to your queries. You can contact us at <strong>techsupport.wtf@gmail.com</strong> for all your queries regarding issues with content.
                </div>
                </div>
            </div>
        </div>
        <?php include "utils/footer.php"?>
    </body>
</html>