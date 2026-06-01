   <?php

    use App\Models\Doctor;
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
                       <h1>Update Doctor</h1>
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
           <?php if (isset($_SESSION['errors'])): ?>
           <div class="alert alert-danger">
               <?php foreach ($_SESSION['errors'] as $error): ?>
               <p><?= $error ?></p>
               <?php endforeach; ?>
           </div>
           <?php unset($_SESSION['errors']); ?>
           <?php endif;
            $id = $_GET['id'] ?? null;
            if ($id) {
                $row = Doctor::findById($pdo, $id);
            } ?>


           <!-- Default box -->
           <div class="container-fluid">
               <form action="index.php?page=store-doctor&action=update-doctor" method="POST" enctype="multipart/form-data">
                   <input type="hidden" name="id" value='<?= $row->getId(); ?>'>

                   <div class="card">
                       <div class="card-body">
                           <div class="row">
                               <div class="col-md-12">
                                   <div class="mb-3">
                                       <label for="name">Name</label>
                                       <input type="text" name="name" id="name" class="form-control" value="<?= $row->getName();
                                        //    var_dump($row);
                                        //    exit; ?>" placeholder="Name">
                                   </div>
                               </div>

                               <div class="col-md-12">
                                   <div class="mb-3">
                                       <label for="name">Email</label>
                                       <input type="email" name="email" id="email" class="form-control"
                                           value="<?= $row->getEmail(); ?>" placeholder="Email">
                                   </div>
                               </div>

                               <div class="col-md-12">
                                   <div class="mb-3">
                                       <label for="name">Phone</label>
                                       <input type="tel" name="phone" id="phone" class="form-control"
                                           value="<?= $row->getPhone(); ?>" placeholder="Phone">
                                   </div>
                               </div>
                               <div class="col-md-12">
                                   <div class="mb-3">
                                       <label for="password">password</label>
                                       <input type="password" name="password" id="name" class="form-control"
                                           placeholder="password" value="">
                                   </div>

                               </div>


                               <div class="col-md-12">
                                   <div class="mb-3">
                                       <label for="name">Major title</label>
                                       <select name="major_id" class="form-control">

                                           <option value="">Select Major</option>

                                           <?php foreach($majors as $major): ?>

                                           <option value="<?= $major->getId(); ?>"
                                               <?= ($row->getMajorId() == $major->getId()) ? 'selected' : ''; ?>>
                                               <?= $major->getTitle(); ?>
                                           </option>

                                           <?php endforeach; ?>

                                       </select>



                                   </div>
                               </div>
                               <div class="col-md-12">
                                   <div class="mb-3">
                                       <label for="image" class="form-label">Image</label>

                                       <img src="<?= $row->getImage(); ?>" width="100" class="mb-2">

                                       <input type="file" name="image" class="form-control">

                                   </div>

                               </div>


                               <div class="col-md-12">
                                   <div class="mb-3">
                                       <label for="description">Description</label>
                                       <textarea name="description" class="form-control" cols="30" rows="5">
                                        <?= $row->getDescription(); ?>
                                        </textarea>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="pb-5 pt-3">
                       <button class="btn btn-primary" type="submit">Update</button>
                       <a href="" class="btn btn-outline-dark ml-3">Cancel</a>
                   </div>
               </form>
           </div>
           <!-- /.card -->
       </section>

       <!-- /.content -->
   </div>
