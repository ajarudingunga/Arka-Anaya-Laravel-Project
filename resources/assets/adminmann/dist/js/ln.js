// Update Page Data Code Start
$('form#FrmUpdatePageData').on('submit', function(event) {
    event.preventDefault();
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }

    var formData = $(this).serialize(); // Form data as string
    var formAction = $(this).attr('action'); // Form handler url
    var formMethod = $(this).attr('method'); // GET, POST

    $.ajaxSetup({
        headers: {
            'X-XSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: formMethod,
        url: formAction,
        data: formData,
        cache: false,
        beforeSend: function() {
            $("#ajax-loader").show();
        },
        success: function(data) {
            $("#ajax-loader").hide();

            // Show validation messages
            if ((data !== undefined) && (data.title !== undefined) && (data.title[0] !== undefined)) {
                var TitleError = data.title[0];
                $(".title-error").text(TitleError);
            } else {
                $(".title-error").text('');
            }

            if ((data !== undefined) && (data.content !== undefined) && (data.content[0] !== undefined)) {
                var ContentError = data.content[0];
                $(".content-error").text(ContentError);
            } else {
                $(".content-error").text('');
            }

            if (data == "") {
                $('#messageAlert').show();
                $("#messageAlert").html('<div class="alert alert-success alert-dismissible"><h4><i class="icon fa fa-check"></i> Success!</h4>Page has been updated successfully.</div>');
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");

                window.setTimeout(function() {
                    window.location = SITE_URL+'pages';
                }, 3000);
            }
        },
        error: function(data) {
            $("#ajax-loader").hide();
            return false;
        }
    });
    // console.log(formData);
    return false; // Prevent send form
});
// Update Page Data Code End

// Update User General Data Code Start
$('form#FrmUpdateGeneralData').on('submit', function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // Form data as string
    var formAction = $(this).attr('action'); // Form handler url
    var formMethod = $(this).attr('method'); // GET, POST

    $.ajaxSetup({
        headers: {
            'X-XSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: formMethod,
        url: formAction,
        data: formData,
        cache: false,
        beforeSend: function() {
            $("#ajax-loader").show();
        },
        success: function(data) {
            $("#ajax-loader").hide();

            // Show validation messages
            if ((data !== undefined) && (data.email !== undefined) && (data.email[0] !== undefined)) {
                var IDError = data.email[0];
                $(".id-error").text(IDError);
            } else {
                $(".id-error").text('');
            }

            if ((data !== undefined) && (data.password !== undefined) && (data.password[0] !== undefined)) {
                var PasswordError = data.password[0];
                $(".password-error").text(PasswordError);
            } else {
                $(".password-error").text('');
            }

            if ((data !== undefined) && (data.password_confirmation !== undefined) && (data.password_confirmation[0] !== undefined)) {
                var ConfirmationError = data.password_confirmation[0];
                $(".confirmation-password-error").text(ConfirmationError);
            } else {
                $(".confirmation-password-error").text('');
            }

            if ((data !== undefined) && (data.first_name !== undefined) && (data.first_name[0] !== undefined)) {
                var FirstNameError = data.first_name[0];
                $(".firstname-error").text(FirstNameError);
            } else {
                $(".firstname-error").text('');
            }

            if ((data !== undefined) && (data.last_name !== undefined) && (data.last_name[0] !== undefined)) {
                var LastNameError = data.last_name[0];
                $(".lastname-error").text(LastNameError);
            } else {
                $(".lastname-error").text('');
            }

            if ((data !== undefined) && (data.Nickname !== undefined) && (data.Nickname[0] !== undefined)) {
                var NicknameError = data.Nickname[0];
                $(".nickname-error").text(NicknameError);
            } else {
                $(".nickname-error").text('');
            }

            if ((data !== undefined) && (data.Birthday !== undefined) && (data.Birthday[0] !== undefined)) {
                var BirthdayError = data.Birthday[0];
                $(".birthday-error").text(BirthdayError);
            } else {
                $(".birthday-error").text('');
            }

            if ((data !== undefined) && (data.Gender !== undefined) && (data.Gender[0] !== undefined)) {
                var GenderError = data.Gender[0];
                $(".gender-error").text(GenderError);
            } else {
                $(".gender-error").text('');
            }

            if ((data !== undefined) && (data.Profile !== undefined) && (data.Profile[0] !== undefined)) {
                var ProfileError = data.Profile[0];
                $(".profile-error").text(ProfileError);
            } else {
                $(".profile-error").text('');
            }

            if ((data !== undefined) && (data.Type !== undefined) && (data.Type[0] !== undefined)) {
                var TypeError = data.Type[0];
                $(".user-type-error").text(TypeError);
            } else {
                $(".user-type-error").text('');
            }

            if (data == "") {
                $('#messageAlert').show();
                $("#messageAlert").html('<div class="alert alert-success alert-dismissible"><h4><i class="icon fa fa-check"></i> Success!</h4>User has been updated successfully.</div>');
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");

                window.setTimeout(function() {
                    window.location = "http://letsnurture.co.uk/demo/vonitto/admin/userdetail";
                }, 3000);
            }
        },
        error: function(data) {
            $("#ajax-loader").hide();
            return false;
        }
    });
    // console.log(formData);
    return false; // Prevent send form
});
// Update User General Data Code End

// Update User Media Data Code Start
$('form#FrmUpdateMediaData').on('submit', function(event) {
    event.preventDefault();

    // var formData = $(this).serialize(); // Form data as string
    var formAction = $(this).attr('action'); // Form handler url
    var formMethod = $(this).attr('method'); // GET, POST

    $.ajaxSetup({
        headers: {
            'X-XSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    var form = new FormData($("#FrmUpdateMediaData")[0]);

    $.ajax({
        type: formMethod,
        url: formAction,
        data: form,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#ajax-loader").show();
        },
        success: function(data) {
            $("#ajax-loader").hide();

            // Show validation messages
            if ((data !== undefined) && (data.image !== undefined) && (data.image[0] !== undefined)) {
                var FileError = data.image[1];
                $(".image-error").text(FileError);
            } else {
                $(".image-error").text('');
            }

            if (data == "") {
                $('#messageAlert').show();
                $("#messageAlert").html('<div class="alert alert-success alert-dismissible"><h4><i class="icon fa fa-check"></i> Success!</h4>User has been updated successfully.</div>');
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");

                window.setTimeout(function() {
                    window.location = "http://letsnurture.co.uk/demo/vonitto/admin/userdetail";
                }, 3000);
            }
        },
        error: function(data) {
            $("#ajax-loader").hide();
            return false;
        }
    });
    // console.log(formData);
    return false; // Prevent send form
});
// Update User Media Data Code Start

// Add New User Code Start
$('form#FrmAddUser').on('submit', function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // Form data as string
    var formAction = $(this).attr('action'); // Form handler url
    var formMethod = $(this).attr('method'); // GET, POST
    var form = new FormData($("#FrmAddUser")[0]);

    $.ajaxSetup({
        headers: {
            'X-XSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: formMethod,
        url: formAction,
        data: form,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#ajax-loader").show();
        },
        success: function(data) {
            $("#ajax-loader").hide();

            // Show validation messages
            if ((data !== undefined) && (data.ID !== undefined) && (data.ID[0] !== undefined)) {
                var IDError = data.ID[0];
                $(".id-error").text(IDError);
            } else {
                $(".id-error").text('');
            }

            if ((data !== undefined) && (data.password !== undefined) && (data.password[0] !== undefined)) {
                var PasswordError = data.password[0];
                $(".password-error").text(PasswordError);
            } else {
                $(".password-error").text('');
            }

            if ((data !== undefined) && (data.password_confirmation !== undefined) && (data.password_confirmation[0] !== undefined)) {
                var ConfirmationError = data.password_confirmation[0];
                $(".confirmation-password-error").text(ConfirmationError);
            } else {
                $(".confirmation-password-error").text('');
            }

            if ((data !== undefined) && (data.FirstName !== undefined) && (data.FirstName[0] !== undefined)) {
                var FirstNameError = data.FirstName[0];
                $(".firstname-error").text(FirstNameError);
            } else {
                $(".firstname-error").text('');
            }

            if ((data !== undefined) && (data.LastName !== undefined) && (data.LastName[0] !== undefined)) {
                var LastNameError = data.LastName[0];
                $(".lastname-error").text(LastNameError);
            } else {
                $(".lastname-error").text('');
            }

            if ((data !== undefined) && (data.Nickname !== undefined) && (data.Nickname[0] !== undefined)) {
                var NicknameError = data.Nickname[0];
                $(".nickname-error").text(NicknameError);
            } else {
                $(".nickname-error").text('');
            }

            if ((data !== undefined) && (data.Birthday !== undefined) && (data.Birthday[0] !== undefined)) {
                var BirthdayError = data.Birthday[0];
                $(".birthday-error").text(BirthdayError);
            } else {
                $(".birthday-error").text('');
            }

            if ((data !== undefined) && (data.Gender !== undefined) && (data.Gender[0] !== undefined)) {
                var GenderError = data.Gender[0];
                $(".gender-error").text(GenderError);
            } else {
                $(".gender-error").text('');
            }

            if ((data !== undefined) && (data.file !== undefined) && (data.file[0] !== undefined)) {
                var FileError = data.file[0];
                $(".profile-img-error").text(FileError);
            } else {
                $(".profile-img-error").text('');
            }

            if ((data !== undefined) && (data.Profile !== undefined) && (data.Profile[0] !== undefined)) {
                var ProfileError = data.Profile[0];
                $(".profile-error").text(ProfileError);
            } else {
                $(".profile-error").text('');
            }

            if ((data !== undefined) && (data.Type !== undefined) && (data.Type[0] !== undefined)) {
                var TypeError = data.Type[0];
                $(".user-type-error").text(TypeError);
            } else {
                $(".user-type-error").text('');
            }

            if (data == "") {
                $('#messageAlert').show();
                $("#messageAlert").html('<div class="alert alert-success alert-dismissible"><h4><i class="icon fa fa-check"></i> Success!</h4>User has been created successfully.</div>');
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");

                window.setTimeout(function() {
                    window.location = SITE_URL+'users';
                }, 3000);
            }
        },
        error: function(data) {
            $("#ajax-loader").hide();
            return false;
        }
    });
    // console.log(formData);
    return false; // Prevent send form
});
// Add New User Code End

// Update Group Data Code Start
$('form#FrmUpdateGroupData').on('submit', function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // Form data as string
    var formAction = $(this).attr('action'); // Form handler url
    var formMethod = $(this).attr('method'); // GET, POST

    $.ajaxSetup({
        headers: {
            'X-XSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: formMethod,
        url: formAction,
        data: formData,
        cache: false,
        beforeSend: function() {
            $("#ajax-loader").show();
        },
        success: function(data) {
            $("#ajax-loader").hide();

            // Show validation messages
            if ((data !== undefined) && (data.title !== undefined) && (data.title[0] !== undefined)) {
                var TitleError = data.title[0];
                $(".title-error").text(TitleError);
            } else {
                $(".title-error").text('');
            }

            if ((data !== undefined) && (data.description !== undefined) && (data.description[0] !== undefined)) {
                var DescriptionError = data.description[0];
                $(".description-error").text(DescriptionError);
            } else {
                $(".description-error").text('');
            }

            if ((data !== undefined) && (data.order !== undefined) && (data.order[0] !== undefined)) {
                var OrderError = data.order[0];
                $(".order-error").text(OrderError);
            } else {
                $(".order-error").text('');
            }

            if (data == "") {
                $('#messageAlert').show();
                $("#messageAlert").html('<div class="alert alert-success alert-dismissible"><h4><i class="icon fa fa-check"></i> Success!</h4>Group has been updated successfully.</div>');
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");

                window.setTimeout(function() {
                    window.location = SITE_URL+'groups';
                }, 3000);
            }
        },
        error: function(data) {
            $("#ajax-loader").hide();
            return false;
        }
    });
    // console.log(formData);
    return false; // Prevent send form
});
// Update Group Data Code End

// Add Group Data Code Start
$('form#FrmAddGroupData').on('submit', function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // Form data as string
    var formAction = $(this).attr('action'); // Form handler url
    var formMethod = $(this).attr('method'); // GET, POST

    $.ajaxSetup({
        headers: {
            'X-XSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: formMethod,
        url: formAction,
        data: formData,
        cache: false,
        beforeSend: function() {
            $("#ajax-loader").show();
        },
        success: function(data) {
            $("#ajax-loader").hide();

            // Show validation messages
            if ((data !== undefined) && (data.title !== undefined) && (data.title[0] !== undefined)) {
                var TitleError = data.title[0];
                $(".title-error").text(TitleError);
            } else {
                $(".title-error").text('');
            }

            if ((data !== undefined) && (data.description !== undefined) && (data.description[0] !== undefined)) {
                var DescriptionError = data.description[0];
                $(".description-error").text(DescriptionError);
            } else {
                $(".description-error").text('');
            }

            if ((data !== undefined) && (data.order !== undefined) && (data.order[0] !== undefined)) {
                var OrderError = data.order[0];
                $(".order-error").text(OrderError);
            } else {
                $(".order-error").text('');
            }

            if (data == "") {
                $('#messageAlert').show();
                $("#messageAlert").html('<div class="alert alert-success alert-dismissible"><h4><i class="icon fa fa-check"></i> Success!</h4>Group has been created successfully.</div>');
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");

                window.setTimeout(function() {
                    window.location = SITE_URL+'groups';
                }, 3000);
            }
        },
        error: function(data) {
            $("#ajax-loader").hide();
            return false;
        }
    });
    // console.log(formData);
    return false; // Prevent send form
});
// Add Group Data Code End

// Update Topic Data Code Start
$('form#FrmUpdateTopicData').on('submit', function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // Form data as string
    var formAction = $(this).attr('action'); // Form handler url
    var formMethod = $(this).attr('method'); // GET, POST

    $.ajaxSetup({
        headers: {
            'X-XSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: formMethod,
        url: formAction,
        data: formData,
        cache: false,
        beforeSend: function() {
            $("#ajax-loader").show();
        },
        success: function(data) {
            $("#ajax-loader").hide();

            // Show validation messages
            if ((data !== undefined) && (data.title !== undefined) && (data.title[0] !== undefined)) {
                var TitleError = data.title[0];
                $(".title-error").text(TitleError);
            } else {
                $(".title-error").text('');
            }

            if ((data !== undefined) && (data.description !== undefined) && (data.description[0] !== undefined)) {
                var DescriptionError = data.description[0];
                $(".description-error").text(DescriptionError);
            } else {
                $(".description-error").text('');
            }

            if ((data !== undefined) && (data.forum_group_id !== undefined) && (data.forum_group_id[0] !== undefined)) {
                var ForumGroupError = data.forum_group_id[0];
                $(".forum-group-id-error").text(ForumGroupError);
            } else {
                $(".forum-group-id-error").text('');
            }

            if ((data !== undefined) && (data.order !== undefined) && (data.order[0] !== undefined)) {
                var OrderError = data.order[0];
                $(".order-error").text(OrderError);
            } else {
                $(".order-error").text('');
            }

            if (data == "") {
                $('#messageAlert').show();
                $("#messageAlert").html('<div class="alert alert-success alert-dismissible"><h4><i class="icon fa fa-check"></i> Success!</h4>Topic has been updated successfully.</div>');
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");

                window.setTimeout(function() {
                    window.location = SITE_URL+'topics';
                }, 3000);
            }
        },
        error: function(data) {
            $("#ajax-loader").hide();
            return false;
        }
    });
    // console.log(formData);
    return false; // Prevent send form
});
// Update Topic Data Code End

// Add Topic Data Code Start
$('form#FrmAddTopicData').on('submit', function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // Form data as string
    var formAction = $(this).attr('action'); // Form handler url
    var formMethod = $(this).attr('method'); // GET, POST

    $.ajaxSetup({
        headers: {
            'X-XSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: formMethod,
        url: formAction,
        data: formData,
        cache: false,
        beforeSend: function() {
            $("#ajax-loader").show();
        },
        success: function(data) {
            $("#ajax-loader").hide();

            // Show validation messages
            if ((data !== undefined) && (data.title !== undefined) && (data.title[0] !== undefined)) {
                var TitleError = data.title[0];
                $(".title-error").text(TitleError);
            } else {
                $(".title-error").text('');
            }

            if ((data !== undefined) && (data.description !== undefined) && (data.description[0] !== undefined)) {
                var DescriptionError = data.description[0];
                $(".description-error").text(DescriptionError);
            } else {
                $(".description-error").text('');
            }

            if ((data !== undefined) && (data.forum_group_id !== undefined) && (data.forum_group_id[0] !== undefined)) {
                var ForumGroupError = data.forum_group_id[0];
                $(".forum-group-id-error").text(ForumGroupError);
            } else {
                $(".forum-group-id-error").text('');
            }

            if ((data !== undefined) && (data.order !== undefined) && (data.order[0] !== undefined)) {
                var OrderError = data.order[0];
                $(".order-error").text(OrderError);
            } else {
                $(".order-error").text('');
            }

            if (data == "") {
                $('#messageAlert').show();
                $("#messageAlert").html('<div class="alert alert-success alert-dismissible"><h4><i class="icon fa fa-check"></i> Success!</h4>Topic has been created successfully.</div>');
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");

                window.setTimeout(function() {
                    window.location = SITE_URL+'topics';
                }, 3000);
            }
        },
        error: function(data) {
            $("#ajax-loader").hide();
            return false;
        }
    });
    // console.log(formData);
    return false; // Prevent send form
});
// Add Topic Data Code End

// Update Post Data Code Start
$('form#FrmUpdatePostData').on('submit', function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // Form data as string
    var formAction = $(this).attr('action'); // Form handler url
    var formMethod = $(this).attr('method'); // GET, POST

    $.ajaxSetup({
        headers: {
            'X-XSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: formMethod,
        url: formAction,
        data: formData,
        cache: false,
        beforeSend: function() {
            $("#ajax-loader").show();
        },
        success: function(data) {
            $("#ajax-loader").hide();

            // Show validation messages
            if ((data !== undefined) && (data.forum_topic !== undefined) && (data.forum_topic[0] !== undefined)) {
                var ForumTopicError = data.forum_topic[0];
                $(".topic-error").text(ForumTopicError);
            } else {
                $(".topic-error").text('');
            }

            if ((data !== undefined) && (data.serial_no !== undefined) && (data.serial_no[0] !== undefined)) {
                var SerialNoError = data.serial_no[0];
                $(".serial-no-error").text(SerialNoError);
            } else {
                $(".serial-no-error").text('');
            }

            if ((data !== undefined) && (data.posted_by !== undefined) && (data.posted_by[0] !== undefined)) {
                var PostedByError = data.posted_by[0];
                $(".posted-by-error").text(PostedByError);
            } else {
                $(".posted-by-error").text('');
            }

            if ((data !== undefined) && (data.text !== undefined) && (data.text[0] !== undefined)) {
                var TextError = data.text[0];
                $(".text-error").text(TextError);
            } else {
                $(".text-error").text('');
            }

            if ((data !== undefined) && (data.likes !== undefined) && (data.likes[0] !== undefined)) {
                var LikesError = data.likes[0];
                $(".likes-error").text(LikesError);
            } else {
                $(".likes-error").text('');
            }

            if ((data !== undefined) && (data.views !== undefined) && (data.views[0] !== undefined)) {
                var ViewsError = data.views[0];
                $(".views-error").text(ViewsError);
            } else {
                $(".views-error").text('');
            }

            if ((data !== undefined) && (data.chained_to !== undefined) && (data.chained_to[0] !== undefined)) {
                var ChainedToError = data.chained_to[0];
                $(".chained-to-error").text(ChainedToError);
            } else {
                $(".chained-to-error").text('');
            }

            if ((data !== undefined) && (data.status !== undefined) && (data.status[0] !== undefined)) {
                var StatusError = data.status[0];
                $(".status-error").text(StatusError);
            } else {
                $(".status-error").text('');
            }

            if (data == "") {
                $('#messageAlert').show();
                $("#messageAlert").html('<div class="alert alert-success alert-dismissible"><h4><i class="icon fa fa-check"></i> Success!</h4>Post has been updated successfully.</div>');
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");

                window.setTimeout(function() {
                    window.location = SITE_URL+'posts';
                }, 3000);
            }
        },
        error: function(data) {
            $("#ajax-loader").hide();
            return false;
        }
    });
    // console.log(formData);
    return false; // Prevent send form
});
// Update Post Data Code End

// Add Post Data Code Start
$('form#FrmAddPostData').on('submit', function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // Form data as string
    var formAction = $(this).attr('action'); // Form handler url
    var formMethod = $(this).attr('method'); // GET, POST

    $.ajaxSetup({
        headers: {
            'X-XSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: formMethod,
        url: formAction,
        data: formData,
        cache: false,
        beforeSend: function() {
            $("#ajax-loader").show();
        },
        success: function(data) {
            $("#ajax-loader").hide();

            // Show validation messages
            if ((data !== undefined) && (data.forum_topic !== undefined) && (data.forum_topic[0] !== undefined)) {
                var ForumTopicError = data.forum_topic[0];
                $(".topic-error").text(ForumTopicError);
            } else {
                $(".topic-error").text('');
            }

            if ((data !== undefined) && (data.serial_no !== undefined) && (data.serial_no[0] !== undefined)) {
                var SerialNoError = data.serial_no[0];
                $(".serial-no-error").text(SerialNoError);
            } else {
                $(".serial-no-error").text('');
            }

            if ((data !== undefined) && (data.posted_by !== undefined) && (data.posted_by[0] !== undefined)) {
                var PostedByError = data.posted_by[0];
                $(".posted-by-error").text(PostedByError);
            } else {
                $(".posted-by-error").text('');
            }

            if ((data !== undefined) && (data.text !== undefined) && (data.text[0] !== undefined)) {
                var TextError = data.text[0];
                $(".text-error").text(TextError);
            } else {
                $(".text-error").text('');
            }

            if ((data !== undefined) && (data.likes !== undefined) && (data.likes[0] !== undefined)) {
                var LikesError = data.likes[0];
                $(".likes-error").text(LikesError);
            } else {
                $(".likes-error").text('');
            }

            if ((data !== undefined) && (data.views !== undefined) && (data.views[0] !== undefined)) {
                var ViewsError = data.views[0];
                $(".views-error").text(ViewsError);
            } else {
                $(".views-error").text('');
            }

            if (data == "") {
                $('#messageAlert').show();
                $("#messageAlert").html('<div class="alert alert-success alert-dismissible"><h4><i class="icon fa fa-check"></i> Success!</h4>Post has been created successfully.</div>');
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");

                window.setTimeout(function() {
                    window.location = SITE_URL+'posts';
                }, 3000);
            }
        },
        error: function(data) {
            $("#ajax-loader").hide();
            return false;
        }
    });
    // console.log(formData);
    return false; // Prevent send form
});
// Update Post Data Code End

// Update Post Comment Data Code Start
$('form#FrmUpdatePostCommentData').on('submit', function(event) {
    event.preventDefault();

    var formData = $(this).serialize(); // Form data as string
    var formAction = $(this).attr('action'); // Form handler url
    var formMethod = $(this).attr('method'); // GET, POST

    $.ajaxSetup({
        headers: {
            'X-XSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: formMethod,
        url: formAction,
        data: formData,
        cache: false,
        beforeSend: function() {
            $("#ajax-loader").show();
        },
        success: function(data) {
            $("#ajax-loader").hide();

            // Show validation messages
            if ((data !== undefined) && (data.forum_topic !== undefined) && (data.forum_topic[0] !== undefined)) {
                var ForumTopicError = data.forum_topic[0];
                $(".topic-error").text(ForumTopicError);
            } else {
                $(".topic-error").text('');
            }

            if ((data !== undefined) && (data.serial_no !== undefined) && (data.serial_no[0] !== undefined)) {
                var SerialNoError = data.serial_no[0];
                $(".serial-no-error").text(SerialNoError);
            } else {
                $(".serial-no-error").text('');
            }

            if ((data !== undefined) && (data.posted_by !== undefined) && (data.posted_by[0] !== undefined)) {
                var PostedByError = data.posted_by[0];
                $(".posted-by-error").text(PostedByError);
            } else {
                $(".posted-by-error").text('');
            }

            if ((data !== undefined) && (data.text !== undefined) && (data.text[0] !== undefined)) {
                var TextError = data.text[0];
                $(".text-error").text(TextError);
            } else {
                $(".text-error").text('');
            }

            if ((data !== undefined) && (data.likes !== undefined) && (data.likes[0] !== undefined)) {
                var LikesError = data.likes[0];
                $(".likes-error").text(LikesError);
            } else {
                $(".likes-error").text('');
            }

            if ((data !== undefined) && (data.views !== undefined) && (data.views[0] !== undefined)) {
                var ViewsError = data.views[0];
                $(".views-error").text(ViewsError);
            } else {
                $(".views-error").text('');
            }

            if ((data !== undefined) && (data.chained_to !== undefined) && (data.chained_to[0] !== undefined)) {
                var ChainedToError = data.chained_to[0];
                $(".chained-to-error").text(ChainedToError);
            } else {
                $(".chained-to-error").text('');
            }

            if ((data !== undefined) && (data.status !== undefined) && (data.status[0] !== undefined)) {
                var StatusError = data.status[0];
                $(".status-error").text(StatusError);
            } else {
                $(".status-error").text('');
            }

            if (data == "") {
                $('#messageAlert').show();
                $("#messageAlert").html('<div class="alert alert-success alert-dismissible"><h4><i class="icon fa fa-check"></i> Success!</h4>Comments has been updated successfully.</div>');
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");

                window.setTimeout(function() {
                    window.location = SITE_URL+'post/comments';
                }, 3000);
            }
        },
        error: function(data) {
            $("#ajax-loader").hide();
            return false;
        }
    });
    // console.log(formData);
    return false; // Prevent send form
});
// Update Post Comment Data Code End
