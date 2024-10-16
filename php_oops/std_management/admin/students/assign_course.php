<?php require_once dirname(__DIR__) . "/../layout/admin/header.php";

use App\database\DB as db;
use App\database\helper as help;

$db = new db;

$help = new help;
?>


<div class="container-fluid card">

    <div class="row">
        <form action="" id="parents">
            <input type="hidden" name="inserts" value="inserts">
            <!-- =================================parent form ============= -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Assign Course</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput8" class="form-label text-primary">First
                                        Name<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="p_f_name"
                                        id="exampleFormControlInput8" placeholder="Mana">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput10" class="form-label text-primary">Last
                                        Name<span class="required">*</span></label>
                                    <input type="text" name="p_l_name" class="form-control"
                                        id="exampleFormControlInput10" placeholder="Wick">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput9" class="form-label text-primary">Email<span
                                            class="required">*</span></label>
                                    <input type="email" class="form-control" name="p_email"
                                        id="exampleFormControlInput9" placeholder="hello@example.com">
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="exampleFormControlTextarea2"
                                        class="form-label text-primary">Address<span class="required">*</span></label>
                                    <textarea class="form-control"  name="p_f_name" id="exampleFormControlTextarea2" rows="6">

                                      </textarea>
                                </div> -->
                            </div>

                            <div class="col-xl-12 col-sm-6">

                                <div class="mb-3">
                                    <label for="exampleFormControlInput11" class="form-label text-primary">Phone
                                        Number<span class="required">*</span></label>
                                    <input type="number" class="form-control" name="p_number"
                                        id="exampleFormControlInput11" placeholder="+123456789">
                                </div>
                                <!-- <label class="form-label text-primary">Payments<span class="required">*</span></label>
                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input"  name="p_number" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label font-w500" for="flexCheckDefault">
                                            Cash
                                        </label>
                                    </div>
                                    <div class="form-check ms-3">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                        <label class="form-check-label font-w500" for="flexCheckDefault1">
                                            Debits
                                        </label>
                                    </div>

                                </div> -->
                            </div>
                        </div>
                        <div class="">
                            <!-- <button class="btn btn-outline-primary me-3">Save as Draft</button> -->
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>




</div>

<div class="container-fluid">
    <?php
    $fetch = $db->select(true, _Parent, "*");

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
                        <th><strong>NAME</strong></th>
                        <th><strong>Email</strong></th>
                        <th><strong>Phone No.</strong></th>
                        <th><strong>Status</strong></th>
                        <th><strong></strong></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $count = 1;
                    foreach ($rowCourse as $course) {
                        # code...
                
                        ?>
                        <tr>
                            <!-- 
                        <td><div class="d-flex align-items-center"><i class="fa fa-circle text-danger me-1"></i> Canceled</div></td>    
                        <td>
                        <div class="form-check custom-checkbox checkbox-success check-lg me-3">
                            <input type="checkbox" class="form-check-input" id="customCheckBox2" required="">
                            <label class="form-check-label" for="customCheckBox2"></label>
                        </div>
                    </td> -->
                            <td><strong><?php echo $count; ?></strong></td>

                            <td><?php echo $course["f_name"] ?>         <?php echo $course["l_name"] ?></td>
                            <td><?php echo $course["email"] ?></td>
                            <td><?php echo $course["contact"] ?></td>

                            <td>
                                <?php
                                if ($course["p_status"] == 1) {
                                    # code...
                        
                                    ?>
                                    <div class="d-flex align-items-center"><i class="fa fa-circle text-success me-1"></i> PUBLISHED
                                    </div>
                                <?php } else if ($course["p_status"] == 0) {


                                    ?>
                                        <div class="d-flex align-items-center"><i class="fa fa-circle text-danger me-1"></i> DRAFT
                                        </div>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <?php

                                    $p_id = $course["p_id"];
                                    $f_name = $course["f_name"];
                                    $l_name = $course["l_name"];
                                    $email = $course["email"];
                                    $p_status = $course["p_status"];
                                    $contact = $course["contact"];

                                    ?>
                                    <a href="javascript:void(0)"
                                        onclick="OnEdit('<?php echo $p_id ?>','<?php echo $f_name ?>','<?php echo $l_name ?>','<?php echo $email ?>','<?php echo $p_status ?>','<?php echo $contact ?>')"
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
        echo "<h1>No Record found</h1>";
    } ?>


</div>

<!-- edit modal  -->

<div class="modal fade" id="edit_modal" style="display: none;" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body row">

                <form action="" id="edit_parents">
                    <input type="hidden" name="updates" value="updates">
                    <input type="hidden" name="p_id" id="p_id" >
                    <!-- =================================parent form ============= -->
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Parents Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-12 col-sm-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput8" class="form-label text-primary">First
                                                Name<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="p_f_name" id="p_f_name"
                                                placeholder="Mana">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput10" class="form-label text-primary">Last
                                                Name<span class="required">*</span></label>
                                            <input type="text" name="p_l_name" class="form-control" id="p_l_name"
                                                placeholder="Wick">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput9"
                                                class="form-label text-primary">Email<span
                                                    class="required">*</span></label>
                                            <input type="email" class="form-control" name="p_email" id="p_email"
                                                placeholder="hello@example.com">
                                        </div>

                                    </div>

                                    <div class="col-xl-12 col-sm-6">

                                        <div class="mb-3">
                                            <label for="exampleFormControlInput11" class="form-label text-primary">Phone
                                                Number<span class="required">*</span></label>
                                            <input type="number" class="form-control" name="p_number" id="p_number"
                                                placeholder="+123456789">
                                        </div>

                                    </div>

                                    <div class="col-xl-12 col-sm-6">

                                        <div class="mb-3" id="c_status">

                                        </div>

                                    </div>

                                </div>
                                <div class="">

                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
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

<!-- =------------- -->



<!-- delete modal  -->


<div class="modal fade" id="delete_modal" style="display: none;" data-bs-backdrop="static" data-bs-keyboard="false"
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
                    <input type="hidden" name="c_id" id="PId">


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


        let c_ids = document.querySelector("#PId");
        c_ids.value = id;



    }

    // --------------------------------------------------------------

    let delCourse = document.querySelector("#del_Course");

    delCourse.addEventListener("submit", async function (e) {
        e.preventDefault();



        let formData = new FormData(delCourse);



        let url = "<?php echo p_form_action; ?>";

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






    function OnEdit(id, f_name, l_name, Email, p_status, contacts) {

        let EditModal = document.querySelector("#edit_modal");

        const myModalAlternative = new bootstrap.Modal(EditModal)
        myModalAlternative.show(EditModal)


        let c_ids = document.querySelector("#p_id");
        c_ids.value = id;

        let p_f_name = document.querySelector("#p_f_name");
        p_f_name.value = f_name

        let p_l_name = document.querySelector("#p_l_name");
        p_l_name.value = l_name


        let email = document.querySelector("#p_email");
        email.value = Email


        let p_number = document.querySelector("#p_number");
        p_number.value = contacts


        let c_statuses = document.querySelector("#c_status");

        let html = `<select name="p_status" class="col-md-12 col-sm-12 default-select form-control wide" tabindex="null">`;
        if (p_status == 1) {

            html += ` <option selected value="${p_status}">PUBLISHED</option>` +
                `<option  value="0">DRAFT</option>`

        }
        else if (p_status == 0) {
            html += `<option selected value="${p_status}">DRAFT</option>` +
                `<option  value="1">PUBLISHED</option>`
        }
        html += `</select>`;

        c_statuses.innerHTML = html





    }


    let Course = document.querySelector("#edit_parents");

    Course.addEventListener("submit", async function (e) {
        e.preventDefault();

        let outline = "";

        let formData = new FormData(Course);
       
        // for (const value of formData.values()) {
        //     console.log(value);
        // }


        let url = "<?php echo p_form_action; ?>";

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

<script>

    let parents = document.querySelector("#parents");

    parents.addEventListener("submit", async function (e) {
        e.preventDefault();



        let formData = new FormData(parents);



        // for (const value of formData.values()) {
        //     console.log(value);
        // }


        let url = "<?php echo p_form_action; ?>";

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

            Course.reset()
            if (editorObject) {
                editorObject.setData(''); // or set to any default value
            }
        }
    })


</script>