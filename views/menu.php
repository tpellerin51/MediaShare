                <div class="col-xs-3">
                    <nav>
                        <ul class="nav nav-pills nav-stacked">
                            <li <?php if ($_SERVER['REQUEST_URI'] == '/') echo 'class="active"'; ?>><a href="../">Home</a></li>
                            <li> <?php echo "<a href=\" index.php?user=" . urlencode($_SESSION['username']) . "\">" . htmlentities($_SESSION['username'], ENT_QUOTES, 'utf-8') . "</a>"; ?></li>
                        </ul>
                    </nav>
                </div>
