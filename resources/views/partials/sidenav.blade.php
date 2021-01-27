{{--@if(Auth::user()->hasAnyPermission(['user-view','role-view']))--}}
<li class="treeview {{ Request::is('class','subjects',
        'class/*','syllabus','syllabus/*',
        'sections', 'sections/*',
        'assignments', 'assignments/*',
        'routines', 'routines/*'

) ? 'active' : '' }}">
    <a href="#"><i
            class="fa fa-id-card"></i>
        <span>Academic</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
</li>
