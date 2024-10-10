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


                            <td>
                                <div class="trans-list">
                                    <a href="<?php echo $image["absUrl"] ?>" target="_blank">
                                        <img src="<?php echo $image["absUrl"] ?>" alt="" class="avatar avatar-sm me-3">
                                    </a>
                                    <!-- <h4>Samantha William</h4> -->
                                </div>
                            </td>


                            <td><?php echo $course["f_name"] ?>         <?php echo $course["l_name"] ?></td>
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

                                    $p_id = $course["std_id"];
                                    $f_name = $course["f_name"];
                                    $l_name = $course["l_name"];
                                    $email = $course["email"];
                                    $p_status = $course["std_status"];
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
        echo "<h1>No RECORD found</h1>";
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
            <div class="modal-body">

                <form id="Course" action="javascript:void(0)">
                    <input type="hidden" name="updates" value="updates">
                    <input type="hidden" name="c_id" id="c_id">
                    <div class="mb-3 row">
                        <label class="col-sm-12 col-form-label">COURSE NAME</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="c_name" name="c_name"
                                placeholder="ENTER COURSE NAME">
                        </div>
                    </div>
                    <div class="mb-1 row">


                        <div class="card ">
                            <label class="col-sm-12 col-form-label">COURSE OUTLINE</label>
                            <textarea id="editor"></textarea>
                        </div>

                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-12 col-form-label">COURSE STATUS</label>
                        <div id="c_status"></div>
                        <!-- <select class="col-md-12 col-sm-12 default-select form-control wide" tabindex="null">
                            <option>PUBLISHED</option>
                            <option>DRAFT</option>

                        </select> -->
                    </div>


                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <button type="submit" id="ok" class="btn btn-primary">SAVE</button>
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


    let editorObject;
    $(document).ready(function () {








        let editor = document.querySelector("#editor");


        ClassicEditor.create(editor).then(e => {


            editorObject = e;

        }).catch(er => {
            console.log(er)
        })

    })



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






    function OnEdit(id, c_name, c_status, c_outline) {

        let EditModal = document.querySelector("#edit_modal");

        const myModalAlternative = new bootstrap.Modal(EditModal)
        myModalAlternative.show(EditModal)


        let c_ids = document.querySelector("#c_id");
        c_ids.value = id;

        let c_names = document.querySelector("#c_name");
        c_names.value = c_name

        let c_statuses = document.querySelector("#c_status");

        let html = `<select name="c_status" class="col-md-12 col-sm-12 default-select form-control wide" tabindex="null">`;
        if (c_status == 1) {

            html += ` <option selected value="${c_status}">PUBLISHED</option>` +
                `<option  value="0">DRAFT</option>`

        }
        else if (c_status == 0) {
            html += `<option selected value="${c_status}">DRAFT</option>` +
                `<option  value="1">PUBLISHED</option>`
        }
        html += `</select>`;

        c_statuses.innerHTML = html


        // ----------------
        if (editorObject) {
            outline = editorObject.setData(c_outline);

        }

    }


    let Course = document.querySelector("#Course");

    Course.addEventListener("submit", async function (e) {
        e.preventDefault();

        let outline = "";

        let formData = new FormData(Course);
        if (editorObject) {
            outline = editorObject.getData();

        }

        formData.append("c_outline", outline)

        // for (const value of formData.values()) {
        //     console.log(value);
        // }


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


</script>