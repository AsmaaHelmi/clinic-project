    <?php
    use App\Models\Major;
$majors=Major::getAll($pdo);

    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Doctor</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="index.php?page=admin-doctor" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->

        <section class="content">
            <section class="content">
                <?php if(isset($_SESSION['errors'])):
                //var_dump($_SESSION['errors']);
                //exit; ?>
                <?php foreach($_SESSION['errors'] as $error): ?>
                <p><?=$error=implode(', ', $error)  ?></p>
                <?php endforeach; ?>
    </div>
    <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>



    <!-- Default box -->
    <div class="container-fluid">
        <form action="index.php?page=store-doctor&action=add" method="POST" enctype="multipart/form-data">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            </div>

                        </div>


                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="name" class="form-control" placeholder="Email">
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="password">password</label>
                                <input type="password" name="password" id="name" class="form-control"
                                    placeholder="password">
                            </div>

                        </div>


                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name">Phone</label>
                                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name">Major title</label>

                                <select name="major_id" class="form-control">

                                    <option value="">Select Major</option>

                                    <?php
                                     foreach($majors as $major): ?>

                                    <option value="<?=$major->getId(); ?>">
                                        <?=$major->getTitle(); ?>
                                    </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" cols="30"
                                    rows="5"></textarea>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary" type="submit">Create</button>
                <a href="" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
    </section>

    <!-- /.content -->
    </div>

    <?php


        // if(isset($_SESSION['errors'])) {

        //     foreach($_SESSION['errors'] as $error) {

        //         print_r( $error);
        //     }

        //     unset($_SESSION['errors']);
        // }
        ?>