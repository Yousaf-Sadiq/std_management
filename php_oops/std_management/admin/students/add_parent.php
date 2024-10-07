<?php require_once dirname(__DIR__) . "/../layout/admin/header.php"; ?>


<div class="container-fluid card">

    <div class="row">
        <form action="" id="parents">
            <input type="hidden" name="inserts" value="inserts">
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

<?php
require_once dirname(__DIR__) . "/../layout/admin/footer.php";
?>


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