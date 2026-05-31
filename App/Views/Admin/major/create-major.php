     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid my-2">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Create Major</h1>
                     </div>
                     <div class="col-sm-6 text-right">
                         <a href="index.php?page=admin-major" class="btn btn-primary">Back</a>
                     </div>
                 </div>
             </div>
             <!-- /.container-fluid -->
         </section>
         <!-- Main content -->

         <section class="content">
            <?php if(isset($_SESSION['errors'])): ?>

          <?php// foreach($_SESSION['errors'] as $error): ?>

          <p class="text-danger"><?= $_SESSION['errors'] ?></p>

          <?php //endforeach; ?>

          <?php unset($_SESSION['errors']); ?>

          <?php endif; ?>



             <!-- Default box -->
             <div class="container-fluid">
                 <form action="index.php?page=store-major&action=add" method="POST">

                     <div class="card">
                         <div class="card-body">
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="mb-3">
                                         <label for="name">Title</label>
                                         <input type="text" name="title" id="name" class="form-control"
                                             placeholder="Title">
                                     </div>

                                 </div>
                                
								 <div class="col-md-12">
										<div class="mb-3">
											<label for="description">Description</label>
											<textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
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
