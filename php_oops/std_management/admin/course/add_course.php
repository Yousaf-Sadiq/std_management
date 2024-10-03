<?php
require_once dirname(__DIR__) . "/../layout/admin/header.php";
?>


<div class="container-fluid card">

    <form id="Course" action="javascript:void(0)">
        <input type="hidden" name="inserts" value="inserts">
        <div class="mb-3 row">
            <label class="col-sm-3  col-md-12 col-form-label">COURSE NAME</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="c_name" placeholder="ENTER COURSE NAME">
            </div>
        </div>
        <div class="mb-3 row">


            <div class="card  bg-white">
                <label class="col-sm-3 col-form-label">COURSE OUTLINE</label>
                <textarea id="editor"></textarea>
            </div>

        </div>




        <div class="mb-3 row">
            <div class="col-sm-10">
                <button type="submit" id="ok" class="btn btn-primary">SAVE</button>
            </div>
        </div>
    </form>
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