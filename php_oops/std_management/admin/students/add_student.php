<?php require_once dirname(__DIR__) . "/../layout/admin/header.php";

use App\database\DB as db;
use App\database\helper as help;

$db = new db;

$help = new help;
?>


<div class="container-fluid card">

    <div class="row">
        <form action="">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Student Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-xl-3 col-lg-4">
                                <label class="form-label text-primary">Photo<span class="required">*</span></label>
                                <div class="avatar-upload">
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url(images/no-img-avatar.png);">
                                        </div>
                                    </div>
                                    <div class="change-btn mt-2 mb-lg-0 mb-3">
                                        <input type='file' class="form-control d-none" id="imageUpload"
                                            accept=".png, .jpg, .jpeg">
                                        <label for="imageUpload" class="dlab-upload mb-0 btn btn-primary btn-sm">Choose
                                            File</label>
                                        <a href="javascript:void"
                                            class="btn btn-danger light remove-img ms-2 btn-sm">Remove</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-8">
                                <div class="row">
                                    <div class="col-xl-12 col-sm-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label text-primary">First
                                                Name<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="f_name"
                                                id="exampleFormControlInput1" placeholder="James">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput4" class="form-label text-primary">Last
                                                Name<span class="required">*</span></label>
                                            <input type="text" name="l_name" class="form-control"
                                                id="exampleFormControlInput4" placeholder="Wally">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-primary">Date & Place of Birth<span
                                                    class="required">*</span></label>
                                            <div class="d-flex">
                                                <input type="text" name="DOB" class="form-control"
                                                    placeholder="2017-06-04" id="datepicker">

                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="" class="col-form-label">Student Parent</label>
                                            <select class="col-md-12 col-sm-12 default-select form-control wide " name="s_parent" id="s_parent">
                                                <option selected>Select one</option>
                                                <?php
                                                $s_p = $db->select(true, _Parent, "*");
                                                if ($s_p) {
                                                    $row_p = $db->GetResult();
                                                    foreach ($row_p as $key => $value) {
                                                        # code...
                                                
                                                        ?>

                                                        <option value="<?php echo $value["p_id"] ?>"><?php echo $value["f_name"] ?> <?php echo $value["l_name"] ?> </option>

                                                        <?php
                                                    }
                                                }

                                                ?>
                                            </select>
                                        </div>


                                        <div class="mb-3">
                                            <label for="exampleFormControlInput3"
                                                class="form-label text-primary">Email<span
                                                    class="required">*</span></label>
                                            <input type="email" name="email" class="form-control"
                                                id="exampleFormControlInput3" placeholder="hello@example.com">
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1"
                                                class="form-label text-primary">Address<span
                                                    class="required">*</span></label>
                                            <textarea class="form-control" name="address"
                                                id="exampleFormControlTextarea1" rows="6">

                                                  </textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlInput6" class="form-label text-primary">Phone
                                                Number<span class="required">*</span></label>
                                            <input type="number" name="std_number" class="form-control"
                                                id="exampleFormControlInput6" placeholder="+123456789">
                                        </div>




                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- =================================parent form ============= -->
            <div class="">
                <!-- <button class="btn btn-outline-primary me-3">Save as Draft</button> -->
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
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

            Course.reset()
            if (editorObject) {
                editorObject.setData(''); // or set to any default value
            }
        }
    })


</script>