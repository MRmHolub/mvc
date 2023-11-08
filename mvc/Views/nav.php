<?php
  echo '
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <title>Simple Dashboard</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

        
      <link rel="stylesheet" href="//localhost/mvc/Views/bootstrap.css">
      <link rel="stylesheet" href="//localhost/mvc/Views/bootstrap-icons.css">                    
      <style>
      /* some hacks for responsive sidebar */
      .sidebar {
        max-width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        padding: 48px 0 0; /* height of navbar */
      }
  
      
      .sidebar-sticky {
        height: calc(100vh - 48px);
        overflow-x: auto;
        overflow-y: auto;
      }
  
      h1 {
        margin-left: 300px;
        max-width: 60%;
      }
  
      table {
          margin-left: 300px;
          width: 60%;
      }
  
      td {
        padding: 15px 10px;
      }
  
      .move_me {
        margin-left: 300px !important;
      }
  
      .half {
        flex: 1 0 0;
        max-width: 60%;
        margin-bottom: 2em;
      }
  
  
      .behind {
        display: inline-block;      
      }
  
      .dialog {
        margin-left: calc(50%-8em);
        width: 16em;
        text-align: center;
      }
  
      .notification {
        max-width: 60%;
      }
      </style>
      </head>
    <body>
     
      <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">        
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">simple administration</a>
        <div class="navbar-nav">
          <div class="nav-item text-nowrap">            
            <a class="nav-link px-3" href="//localhost/mvc/logout">logout</a>
          </div>
        </div>
      </header>
          <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky pt-3 sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a href="dashboard" class="nav-link active" aria-current="page">
                    <span class="icon">
                      <i class="bi bi-easel"></i>
                    </span>
                    Dashboard
                  </a>
                </li>
                <li>
                  <a href="//localhost/mvc/items" class="nav-link link-dark">
                    <span class="icon">
                      <i class="bi bi-card-list"></i>
                    </span>
                    Items
                  </a>
                </li>
                <li>
                  <a href="//localhost/mvc/others" class="nav-link link-dark">
                    <span class="icon">
                      <i class="bi bi-box"></i>
                    </span>
                    Others
                  </a>
                </li>
                <li>
                  <a href="//localhost/mvc/users" class="nav-link link-dark">
                    <span class="icon">
                      <i class="bi bi-person-circle"></i>
                    </span>
                    Users
                  </a>
                </li>
              </ul>
            </div>            
          </nav>

          <main>   
          <script type="text/javascript" src="myfunctions.js"></script>
          <script type="text/javascript" src="bootstrap.js"></script>       
  ';
?>