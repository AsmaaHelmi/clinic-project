<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">

        <div class="container-fluid my-2">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Create Major</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="index.php?page=admin-major" class="btn btn-primary">
                        Back
                    </a>
                </div>

            </div>

        </div>

    </section>

    <!-- Main content -->
    <section class="content">

        <?php if(isset($_SESSION['errors'])): ?>

            <p class="text-danger">
                <?= $_SESSION['errors'] ?>
            </p>

            <?php unset($_SESSION['errors']); ?>

        <?php endif; ?>

        <div class="container-fluid">

            <form
                action="index.php?page=store-major&action=add"
                method="POST"
                enctype="multipart/form-data"
            >

                <div class="card">

                    <div class="card-body">

                        <div class="row">

                            <!-- Title -->
                            <div class="col-md-12">

                                <div class="mb-3">

                                    <label for="title">Title</label>

                                    <input
                                        type="text"
                                        name="title"
                                        id="title"
                                        class="form-control"
                                        placeholder="Title"
                                    >

                                </div>

                            </div>

                            <!-- Description -->
                            <div class="col-md-12">

                                <div class="mb-3">

                                    <label for="description">
                                        Description
                                    </label>

                                    <textarea
                                        name="description"
                                        id="description"
                                        class="form-control"
                                        cols="30"
                                        rows="5"
                                    ></textarea>

                                </div>

                            </div>

                            <!-- Image -->
                            <div class="col-md-12">

                                <div class="mb-3">

                                    <label for="image">Image</label>

                                    <input
                                        type="file"
                                        name="image"
                                        id="image"
                                        class="form-control"
                                    >

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="pb-5 pt-3">

                    <button
                        class="btn btn-primary"
                        type="submit"
                    >
                        Create
                    </button>

                    <a
                        href="index.php?page=admin-major"
                        class="btn btn-outline-dark ml-3"
                    >
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </section>

</div>

