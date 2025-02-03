<div class="sidebar nav">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">CodingLab</span>
    </div>
      <ul class="nav-links">
        
        <li>
          <a href="#" class="out">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
       @can('user_index')
        <li>
          <a href="{{route('user.index')}}" class="out">
            <i class='bx bx-box' ></i>
            <span class="links_name">User</span>
          </a>
        </li>
        @endcan
        
        @can('permission_index')
        <li>
          <a href="{{route('permission.index')}}" class="out">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Permission</span>
          </a>
        </li>
        @endcan
        
        @can('role_index')
        <li>
          <a href="{{route('role.index')}}" class="out">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Role</span>
          </a>
        </li>
        @endcan
        <li>
          <a href="{{route('block.index')}}" class="out">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Block</span>
          </a>
        </li>
        <li>
          <a href="{{route('page.index')}}" class="out">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">page</span>
          </a>
        </li>
        <li>
          <a href="{{route('slider.index')}}" class="out">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Slider</span>
          </a>
        </li>
        <li>
          <a href="{{route('category.index')}}" class="out">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Category</span>
          </a>
        </li>
        <li>
          <a href="{{route('product.index')}}" class="out">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Product</span>
          </a>
        </li>
        <li>
          <a href="{{route('orders')}}" class="out">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Orders</span>
          </a>
        </li>
        @can('attribute_index')
        <li>
          <a href="{{route('attribute.index')}}" class="out">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Attribute</span>
          </a>
        </li>
        @endcan
        <li>
          <a href="{{route('attribute-value.index')}}" class="out">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Attribute Value</span>
          </a>
        </li>
        
        <li class="#">
          <a href="{{ route('logout') }}" class="out">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <script>
    $(document).ready(function () {
    $('.nav li').click(function(e) {

        $('.nav li').removeClass('active');

        var $this = $(this);
        if (!$this.hasClass('active')) {
            $this.addClass('active');
        }
        //e.preventDefault();
    });
});
  </script>


<style>
  .active{
    background-color: #000;
  }
</style>







