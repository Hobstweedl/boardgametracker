                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
                    </li>
                
                    
                    <li>
                        <a  href="{{ action('PlaythroughController@getList')}}"><i class="fa fa-fa-puzzle-piece fa-3x"></i> Dashboard</a>
                    </li>

                    <li>
                        <a  href="#"><i class="fa fa-puzzle-piece fa-3x"></i> Games Played<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                            <li>
                                <a href="{{ action('PlaythroughController@getList')}}">Show Games Played</a>
                            </li>
                            <li>
                                <a href="{{ action('PlaythroughController@getAdd')}}">Add Playthrough</a>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a  href="#"><i class="fa fa-gamepad fa-3x"></i> Games<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                            <li>
                                <a href="{{ action('GameController@getList')}}">Show Games</a>
                            </li>
                            <li>
                                <a href="{{ action('GameController@getAdd')}}">Add Game</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a  href=""><i class="fa fa-user fa-3x"></i> Users<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                            <li>
                                <a href="{{ action('UserController@getList')}}">Show Users</a>
                            </li>
                            <li>
                                <a href="{{ action('UserController@getAdd')}}">Add User</a>
                            </li>
                        </ul>
                    </li>
                    <!--
                    <li  >
                        <a  href="chart.html"><i class="fa fa-bar-chart-o fa-3x"></i> Morris Charts</a>
                    </li>   
                      <li  >
                        <a  href="table.html"><i class="fa fa-table fa-3x"></i> Table Examples</a>
                    </li>
                    <li  >
                        <a  href="form.html"><i class="fa fa-edit fa-3x"></i> Forms </a>
                    </li>               
                    <li  >
                        <a   href="login.html"><i class="fa fa-bolt fa-3x"></i> Login</a>
                    </li>   
                     <li  >
                        <a   href="registeration.html"><i class="fa fa-laptop fa-3x"></i> Registeration</a>
                    </li>   
                                       
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>
                               
                            </li>
                        </ul>
                      </li>  
                  <li  >
                        <a class="active-menu"  href="blank.html"><i class="fa fa-square-o fa-3x"></i> Blank Page</a>
                    </li>  
                    --> 
                </ul>
               
            </div>
            
        </nav>  