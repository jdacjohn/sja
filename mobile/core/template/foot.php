<?php

?>
</div>
<div id="foot">
<ul>
<li><a href="/mobile">Home</a></li>
<li><a href="/mobile/announcements">Announcements</a></li>
<li><a href="/mobile/calendar">Calendar</a></li>
<li><a href="/mobile/students">Students</a></li>
<li><a href="/mobile/parents">Parents</a></li>
<li><a href="/mobile/faculty">Faculty</a></li>
<li><a href="/mobile/alumni">Alumni</a></li>
<li><a href="/mobile/about-us">About Us</a></li>
</ul>
<p><?php $copyYear = 2011; $curYear = date('Y'); echo ' &copy;' . $copyYear . (($copyYear != $curYear) ? '-' . $curYear : ' '); ?> Saint Joseph Academy</p>
</div>
</div>

</body>
</html>
<?php ob_flush(); ?>