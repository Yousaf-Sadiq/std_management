<?php
require_once dirname(__DIR__) . "/../layout/admin/header.php";

use App\database\DB as DB;
use App\database\helper as help;

$db = new DB;
$help = new help();
?>


<div class="container-fluid">
    <?php
    $fetch = $db->select(true, _std, "*");

    if ($fetch) {
        $rowCourse = $db->GetResult();
        ?>
        <div class="table-responsive">
            <table class="table table-responsive-md">
                <thead>
                    <tr>
                        <!-- <th style="width:50px;">
                        <div class="form-check custom-checkbox checkbox-success check-lg me-3">
                            <input type="checkbox" class="form-check-input" id="checkAll" required="">
                            <label class="form-check-label" for="checkAll"></label>
                        </div>
                    </th> -->
                        <th><strong>#</strong></th>
                        <th><strong>Image</strong></th>
                        <th><strong> NAME</strong></th>
                        <th><strong> Parent NAME</strong></th>
                        <th><strong> EMAIL</strong></th>
                        <th><strong> DATE OF BIRTH</strong></th>
                        <th><strong> CONTACT</strong></th>
                        <th><strong>Status</strong></th>
                        <th><strong></strong></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $count = 1;
                    foreach ($rowCourse as $course) {
                        # code...
                        if (isset($course["profile"]) && !empty($course["profile"])) {
                            $image = json_decode($course["profile"], true);

                        } else {
                            $image["absUrl"] = abs_url . "assets/admin/images/no-img-avatar.png";
                        }



                        $p_s_fetch = $db->select(true, _std_parent, "*", "`student_id`='{$course["std_id"]}'");
                        if ($p_s_fetch) {
                            $p_s_row = $db->GetResult();

                            $p_fetch = $db->select(true, _Parent, "*", "`p_id`='{$p_s_row[0]["parent_id"]}'");
                            $p_row = $db->GetResult();
                            $p_name = $p_row[0]["f_name"] . " " . $p_row[0]["l_name"];
                        } else {
                            $p_name = "not defined";
                        }
                        ?>
                        <tr>


                            <td><strong><?php echo $count; ?></strong></td>


                            <td>
                                <div class="trans-list">
                                    <a href="<?php echo $image["absUrl"] ?>" target="_blank">
                                        <img src="<?php echo $image["absUrl"] ?>" alt="" class="avatar avatar-sm me-3">
                                    </a>

                                </div>
                            </td>


                            <td><?php echo $course["f_name"] ?>         <?php echo $course["l_name"] ?></td>
                            <td><?php echo $p_name ?> </td>

                            <td><?php echo $course["email"] ?></td>
                            <td><?php echo $course["DOB"] ?></td>
                            <td><?php echo $course["contact"] ?></td>

                            <td>
                                <?php
                                if ($course["std_status"] == 1) {
                                    # code...
                        
                                    ?>
                                    <div class="d-flex align-items-center"><i class="fa fa-circle text-success me-1"></i> PUBLISHED
                                    </div>
                                <?php } else if ($course["std_status"] == 0) {


                                    ?>
                                        <div class="d-flex align-items-center"><i class="fa fa-circle text-danger me-1"></i> DRAFT
                                        </div>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <?php

                                    $std_id = $course["std_id"];
                                    $f_name = $course["f_name"];
                                    $l_name = $course["l_name"];
                                    $email = $course["email"];
                                    $std_status = $course["std_status"];
                                    $contact = $course["contact"];
                                    $address = $course["address"];
                                    $DOB = $course["DOB"];
                                    $p_id = $p_row[0]["p_id"];
                                    $images = $image["absUrl"];

                                    ?>
                                    <a href="javascript:void(0)"
                                        onclick="OnEdit('<?php echo $std_id ?>','<?php echo $f_name ?>','<?php echo $l_name ?>','<?php echo $email ?>','<?php echo $std_status ?>','<?php echo $contact ?>','<?php echo $address ?>','<?php echo $p_id ?>','<?php echo $DOB ?>','<?php echo $images ?>')"
                                        class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>

                                    <a href="javascript:void(0)" onclick="OnDelete('<?php echo $p_id ?>')"
                                        class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $count++;
                    } ?>
                </tbody>
            </table>
        </div>
    <?php } else {
        echo "<h1>No RECORD found</h1>";
    } ?>


</div>

<!-- edit modal  -->

<div class="modal fade modal-lg" id="edit_modal" style="display: none;" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">

                <form action="javascript:void(0)" id="edit_student">

                    <input type="hidden" name="updates" value="updates">
                    <input type="text" id="std_id" name="std_id">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Student Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-xl-3 col-lg-4">
                                        <label class="form-label text-primary">Photo<span
                                                class="required">*</span></label>
                                        <div class="avatar-upload">
                                            <div class="avatar-preview">
                                                <div id="EditimagePreview">
                                                </div>
                                            </div>
                                            <div class="change-btn mt-2 mb-lg-0 mb-3">
                                                <input type='file' name="profile" class="form-control d-none"
                                                    id="Edit_imageUpload" accept=".png, .jpg, .jpeg">


                                                <label for="Edit_imageUpload"
                                                    class="dlab-upload mb-0 btn btn-primary btn-sm">Choose
                                                    File</label>
                                                <!-- <a href="javascript:void"
                                class="btn btn-danger light remove-img ms-2 btn-sm">Remove</a> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-9 col-lg-8">
                                        <div class="row">
                                            <div class="col-xl-12 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1"
                                                        class="form-label text-primary">First
                                                        Name<span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="s_f_name"
                                                        id="s_f_name" placeholder="James">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput4"
                                                        class="form-label text-primary">Last
                                                        Name<span class="required">*</span></label>
                                                    <input type="text" name="s_l_name" class="form-control"
                                                        id="s_l_name" placeholder="Wally">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label text-primary">Date of Birth<span
                                                            class="required">*</span></label>
                                                    <div class="d-flex">
                                                        <input type="text" name="DOB" class="form-control"
                                                            placeholder="2017-06-04" id="datepicker">

                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <label for="" class="col-form-label">Student Parent</label>

                                                    <div id="s_parent2"></div>


                                                </div>





                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput3"
                                                        class="form-label text-primary">Email<span
                                                            class="required">*</span></label>
                                                    <input type="email" name="s_email" class="form-control" id="s_email"
                                                        placeholder="hello@example.com">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1"
                                                        class="form-label text-primary">Address<span
                                                            class="required">*</span></label>
                                                    <textarea class="form-control" name="s_address" id="s_address"
                                                        rows="6"></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput6"
                                                        class="form-label text-primary">Phone
                                                        Number<span class="required">*</span></label>
                                                    <input type="number" name="std_number" class="form-control"
                                                        id="std_number" placeholder="+123456789">
                                                </div>


                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput6"
                                                        class="form-label text-primary"> Student Status<span
                                                            class="required">*</span></label>

                                                    <div id="std_status"></div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <!-- <button class="btn btn-outline-primary me-3">Save as Draft</button> -->
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>

                        </div>

                    </div>


                    <!-- =================================parent form ============= -->

                </form>


            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>

<!-- =------------- -->



<!-- delete modal  -->


<div class="modal fade " id="delete_modal" style="display: none;" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DELETE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">

                <h1> ARE YOU SURE <span class="text-danger">!</span> </h1>


                <form id="del_Course" action="javascript:void(0)">
                    <input type="hidden" name="deletes" value="deletes">
                    <input type="hidden" name="c_id" id="cId">


                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <button type="submit" id="ok" class="btn btn-primary">DELETE</button>
                        </div>
                    </div>
                </form>


            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>



<?php
require_once dirname(__DIR__) . "/../layout/admin/footer.php";
?>


<script>






    function OnDelete(id) {

        let DeleteModal = document.querySelector("#delete_modal");

        const myModalAlternative = new bootstrap.Modal(DeleteModal)
        myModalAlternative.show(DeleteModal)


        let c_ids = document.querySelector("#cId");
        c_ids.value = id;



    }

    // --------------------------------------------------------------

    let delCourse = document.querySelector("#del_Course");

    delCourse.addEventListener("submit", async function (e) {
        e.preventDefault();



        let formData = new FormData(delCourse);



        let url = "<?php echo c_form_action; ?>";

        let options = {
            method: "POST",
            body: formData
        };

        let data = await fetch(url, options);
        let res = await data.json();
        console.log(res);

        if (res.error && res.error > 0) {

            for (const key in res.msg) {

                ALertMSG("error", res.msg[key], "danger")
            }
        }
        else {

            ALertMSG("error", res.msg, "success");

            setTimeout(() => {
                location.reload();
            }, 1000);
        }
    })


    // =============================================================





    async function OnEdit(stdId, fName, fLame, sEmail, stdStatus, sContact, sAddress, pId, dob, img) {

        let EditModal = document.querySelector("#edit_modal");

        const myModalAlternative = new bootstrap.Modal(EditModal)
        myModalAlternative.show(EditModal)


        let std_id = document.querySelector("#std_id");
        std_id.value = stdId;

        let s_f_name = document.querySelector("#s_f_name");
        s_f_name.value = fName


        let s_l_name = document.querySelector("#s_l_name");
        s_l_name.value = fLame

        let datepicker = document.querySelector("#datepicker");
        datepicker.value = dob

        let s_email = document.querySelector("#s_email");
        s_email.value = sEmail

        let s_address = document.querySelector("#s_address");
        s_address.value = sAddress

        let std_number = document.querySelector("#std_number");
        std_number.value = sContact

        let image_Preview = document.querySelector("#EditimagePreview");
        image_Preview.style.setProperty('background-image', `url('${img}')`);

        // image_Preview.style.backgroundImage = `url('${imag}') !important`;

        // console.log(`url('${imag}') !important`)



        let url = "<?php echo viewStd ?>";
        let form_data = new FormData();



        form_data.append("p_id", pId)


        let op = {
            method: "POST",
            body: form_data
        }

        let edit_p = await fetch(url, op);
        let edit_res = await edit_p.json()


        let s_parent = document.querySelector("#s_parent2");

        let output = ` <select
                                                        class="col-md-12 col-sm-12 default-select form-control wide "
                                                        name="s_parent" id="s_parent">`;
        for (const key in edit_res) {
            output += edit_res[key];
        }

        output += `</select>`;
        // console.log(output);

        s_parent.innerHTML = output;



        let std_status = document.querySelector("#std_status");

        let html = `<select name="std_status" class="col-md-12 col-sm-12 default-select form-control wide" tabindex="null">`;
        if (stdStatus == 1) {

            html += ` <option selected value="${stdStatus}">PUBLISHED</option>` +
                `<option  value="0">DRAFT</option>`

        }
        else if (stdStatus == 0) {
            html += `<option selected value="${stdStatus}">DRAFT</option>` +
                `<option  value="1">PUBLISHED</option>`
        }
        html += `</select>`;

        std_status.innerHTML = html



    }


    let edit_student = document.querySelector("#edit_student");

    let EditFile = "profile";

    Edit_imageUpload = document.querySelector("#Edit_imageUpload");

    Edit_imageUpload.addEventListener("change", function () {

        EditFile = Edit_imageUpload.files[0];
        let image_Preview = document.querySelector("#EditimagePreview");

        $q = showFileSize("Edit_imageUpload")
        if ($q == 1 || $q == 2 || $q == 3) {
            return;
        }

        let reader = new FileReader();

        reader.onload = function (t) {
            // console.log();
            let imageUrl = t.target.result;
            image_Preview.style.setProperty('background-image', `url('${imageUrl}')`);
            // image_Preview.style.backgroundImage = `url(${imageUrl})`;
        }

        if (EditFile) {
            reader.readAsDataURL(EditFile)
        }
    })


    edit_student.addEventListener("submit", async function (e) {
        e.preventDefault();

        console.log(EditFile);


        let formData = new FormData(edit_student);

        formData.append("profile", EditFile)

        // for (const value of formData.values()) {
        //     console.log(value);
        // }


        let url = "<?php echo s_form_action; ?>";

        let options = {
            method: "POST",
            body: formData
        };

        let data = await fetch(url, options);
        let res = await data.json();
        console.log(res);

        if (res.error && res.error > 0) {

            for (const key in res.msg) {

                ALertMSG("error", res.msg[key], "danger")
            }
        }
        else {

            ALertMSG("error", res.msg, "success");

            setTimeout(() => {
                location.reload();
            }, 1000);
        }
    })


</script>