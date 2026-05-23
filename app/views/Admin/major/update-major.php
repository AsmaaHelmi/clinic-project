   <?php
   use App\Models\Major;
 
?>
   
   <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid my-2">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Update Major</h1>
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
             <div class="alert alert-danger">
                 <?php foreach($_SESSION['errors'] as $error): ?>
                 <p><?= $error ?></p>
                 <?php endforeach; ?>
             </div>
             <?php unset($_SESSION['errors']); ?>
             <?php endif; 
                $id = $_GET['id'] ?? null;
     if ($id) {
   $row=Major::findById($pdo,$id);}
 // foreach($row ?? [] as $major):
//   var_dump($row->getTitle());
//   exit;?>


             <!-- Default box -->
             <div class="container-fluid">
                 <form action="index.php?page=store-major&action=update" method="POST">
                    <input type="hidden" name="id" value='<?=$row->getId();?>'>

                     <div class="card">
                         <div class="card-body">
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="mb-3">
                                         <label for="name">Title</label>
                                         <input type="text" name="title" id="name" class="form-control" value="<?=$row->getTitle();?>"
                                             placeholder="Title">
                                     </div>

                                 </div>
                                
								 <div class="col-md-12">
										<div class="mb-3">
											<label for="description">Description</label>
											<textarea name="description" id="description"  class="form-control" cols="30" rows="5"><?=$row->getDescription();?></textarea>
										</div>
									</div>
                             </div>
                         </div>
                     </div>
                     <?php// endforeach;?>
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
