  @extends('admin.layouts.app')
  @section('contents')
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Dashboard</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Dashboard v1</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                          <div class="inner">
                              <h3>Total Products</h3>

                              <h4>{{ $totalproduct }} Products</h4>
                          </div>
                          <div class="icon">
                              <i class="ion ion-bag"></i>
                          </div>
                          <a href="{{ route('product.index') }}" class="small-box-footer">More info <i
                                  class="fas fa-arrow-circle-right"></i></a>
                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                          <div class="inner">
                              <h3>Total Categories</h3>
                              <h4>{{ $totalcategory }} Categories</h4>
                          </div>
                          <div class="icon">
                              <i class="fas fa-folder-open"></i> <!-- Changed to folder icon -->
                          </div>
                          <a href="{{ route('category.index') }}" class="small-box-footer">
                              More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                      </div>
                  </div>

                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                          <div class="inner">
                              <h3>Total Users</h3>

                              <h4>{{ $totaluser }} Users</h4>
                          </div>
                          <div class="icon">
                              <i class="ion ion-person-add"></i>
                          </div>
                          <a href="{{ route('user.index') }}" class="small-box-footer">More info <i
                                  class="fas fa-arrow-circle-right"></i></a>
                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                          <div class="inner">
                              <h3>Total Roles</h3>
                              <h4>{{ $totalrole }} Roles</h4>
                          </div>
                          <div class="icon">
                              <i class="fas fa-users-cog"></i> <!-- Changed icon here -->
                          </div>
                          <a href="{{ route('role.index') }}" class="small-box-footer">
                              More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                      </div>
                  </div>

              </div>
          </div>
          </div>
      </section>
  @endsection
