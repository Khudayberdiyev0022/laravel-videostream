@extends('layouts.app')
@section('content')

  <h3>Nested Tables <small class="text-muted">with tree view-like connecting lines</small></h3>

  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">+ Create Menu</a>
  </div>

  <div class="table-responsive">
    <table class="table table-condensed table-hover">
      <thead>
      <tr>
        <th style="width: 30px;"></th>
        <th>Name</th>
        <th>Slug</th>
        <th>URL</th>
        <th>Status</th>
        <th style="width: 100px;">Actions</th>
      </tr>
      </thead>
      <tbody>
      @foreach($menus as $menu)
        <tr
            data-menu-id="{{ $menu->id }}"
            data-children='@json($menu->childrenRecursive)'
        >
          <td>
            @if($menu->childrenRecursive->isNotEmpty())
              <span class="fa fa-chevron-right fa-fw"></span>
            @endif
          </td>
          <td>{{ $menu->name }}</td>
          <td>{{ $menu->slug }}</td>
          <td>{{ $menu->url ?? $menu->external_link }}</td>
          <td>
            <span class="badge {{ $menu->is_active ? 'bg-success' : 'bg-danger' }}">
                {{ $menu->is_active ? 'Active' : 'Inactive' }}
            </span>
          </td>
          <td>
            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-primary btn-sm">Edit</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

  <!-- TEMPLATE -->
  <template id="tr-detail-template">
    <tr class="tr-detail">
      <td></td>
      <td colspan="5">
        <div class="detail-content">
          <ul class="children-list"></ul>
        </div>
      </td>
    </tr>
  </template>

  <!-- CSS -->
  <style>
    /* Table styles */
    span.fa {
      cursor: pointer;
      transition: all 0.3s;
    }
    span.fa:hover {
      color: #333;
    }
    .tr-selected td:not(:first-child) {
      background: #337ab7;
      color: #fff;
    }
    .tr-detail > td {
      padding: 0 !important;
      border-top: none !important;
    }

    /* Detail content */
    .detail-content {
      padding: 15px 0;
    }

    .detail-content ul {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .detail-content li {
      position: relative;
      padding-left: 30px;
      margin-bottom: 15px;
    }

    .detail-content > ul > li {
      padding-left: 0;
    }

    /* Vertikal chiziq */
    .detail-content li::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      bottom: -15px;
      width: 1px;
      background: repeating-linear-gradient(
          to bottom,
          #337ab7 0px,
          #337ab7 4px,
          transparent 4px,
          transparent 8px
      );
    }

    .detail-content > ul > li::before {
      display: none;
    }

    /* Horizontal line */
    .detail-content li::after {
      content: '';
      position: absolute;
      left: 0;
      top: 25px;
      width: 20px;
      height: 1px;
      background: repeating-linear-gradient(
          to right,
          #337ab7 0px,
          #337ab7 4px,
          transparent 4px,
          transparent 8px
      );
    }

    .detail-content > ul > li::after {
      display: none;
    }

    .detail-content li:last-child::before {
      bottom: auto;
      height: 25px;
    }

    /* Fieldset */
    .detail-content fieldset {
      border: 1px solid #77acd9;
      padding: 10px;
      margin-bottom: 10px;
      background: #fff;
    }

    .detail-content fieldset legend {
      font-size: 90%;
      margin-left: 5px;
      width: 100%;
      margin-bottom: 0;
      border: none;
      padding: 0 5px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .detail-content fieldset legend .btn {
      font-size: 11px;
      padding: 2px 8px;
      margin-left: 5px;
    }

    .detail-content table.table-condensed {
      margin-bottom: 0;
    }

    .detail-content table.table-condensed td {
      padding: 3px 5px;
    }

    .detail-content ul ul {
      margin-top: 10px;
    }
  </style>

  <!-- JavaScript -->
  <script>
      function renderChildren(children, level = 1) {
          const ul = document.createElement('ul');

          children.forEach((child) => {
              const li = document.createElement('li');
              const fieldset = document.createElement('fieldset');

              // Locations HTML
              let locationsHtml = '';
              if (child.locations && child.locations.length > 0) {
                  locationsHtml = child.locations.map(loc =>
                      `<span class="badge bg-primary" style="margin-right: 3px;">${loc}</span>`
                  ).join('');
              } else {
                  locationsHtml = '-';
              }

              fieldset.innerHTML = `
                <legend>
                    <span class="label label-primary">
                        ${child.name}
                        ${child.children_recursive && child.children_recursive.length > 0
                  ? ` <small>(${child.children_recursive.length})</small>`
                  : ''}
                    </span>
                    <div style="float: right;">
                        <a href="/admin/menus/${child.id}/edit" class="btn btn-primary btn-xs">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <button onclick="deleteMenu(${child.id})" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </div>
                </legend>
                <div>
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td style="width: 130px;"><strong>ID:</strong></td>
                                <td>${child.id}</td>
                            </tr>
                            <tr>
                                <td><strong>Slug:</strong></td>
                                <td>${child.slug}</td>
                            </tr>
                            <tr>
                                <td><strong>URL:</strong></td>
                                <td>${child.url || '-'}</td>
                            </tr>
                            <tr>
                                <td><strong>External Link:</strong></td>
                                <td>${child.external_link || '-'}</td>
                            </tr>
                            <tr>
                                <td><strong>Order:</strong></td>
                                <td>${child.order}</td>
                            </tr>
                            <tr>
                                <td><strong>Icon:</strong></td>
                                <td>${child.icon ? `<i class="${child.icon}"></i> ${child.icon}` : '-'}</td>
                            </tr>
                            <tr>
                                <td><strong>Target:</strong></td>
                                <td>${child.target}</td>
                            </tr>
                            <tr>
                                <td><strong>Locations:</strong></td>
                                <td>${locationsHtml}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span class="badge ${child.is_active ? 'bg-success' : 'bg-danger'}">
                                        ${child.is_active ? 'Active' : 'Inactive'}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>${new Date(child.created_at).toLocaleDateString()}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated:</strong></td>
                                <td>${new Date(child.updated_at).toLocaleDateString()}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `;

              li.appendChild(fieldset);

              // RECURSIVE
              if (child.children_recursive && Array.isArray(child.children_recursive) && child.children_recursive.length > 0) {
                  const nestedUl = renderChildren(child.children_recursive, level + 1);
                  li.appendChild(nestedUl);
              }

              ul.appendChild(li);
          });

          return ul;
      }

      // Delete function
      function deleteMenu(menuId) {
          if (!confirm('Are you sure you want to delete this menu?')) {
              return;
          }

          // CSRF token
          const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
          if (!token) {
              alert('CSRF token not found!');
              return;
          }

          // Delete request
          fetch(`/admin/menus/${menuId}`, {
              method: 'DELETE',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': token,
                  'Accept': 'application/json'
              }
          })
              .then(response => {
                  if (response.ok) {
                      alert('Menu deleted successfully!');
                      window.location.reload();
                  } else {
                      alert('Error deleting menu!');
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
                  alert('Error deleting menu!');
              });
      }

      document.addEventListener('DOMContentLoaded', function () {
          document.addEventListener('click', function (e) {
              const icon = e.target.closest('span.fa');
              if (!icon) return;

              const parentTr = icon.closest('tr');
              const childrenRaw = parentTr.dataset.children;

              if (!childrenRaw || childrenRaw === '[]') {
                  return;
              }

              let children;
              try {
                  children = JSON.parse(childrenRaw);
              } catch (err) {
                  console.error('JSON parse error:', err);
                  return;
              }

              // CLOSE
              if (icon.classList.contains('fa-rotate-90')) {
                  icon.classList.remove('fa-rotate-90');
                  parentTr.classList.remove('tr-selected');

                  const detailTr = parentTr.nextElementSibling;
                  if (detailTr && detailTr.classList.contains('tr-detail')) {
                      detailTr.remove();
                  }
                  return;
              }

              // OPEN
              icon.classList.add('fa-rotate-90');
              parentTr.classList.add('tr-selected');

              if (parentTr.nextElementSibling &&
                  parentTr.nextElementSibling.classList.contains('tr-detail')) {
                  return;
              }

              const tpl = document.getElementById('tr-detail-template');
              if (!tpl) {
                  console.error('Template topilmadi!');
                  return;
              }

              const clone = tpl.content.cloneNode(true);
              parentTr.after(clone);

              const detailRow = parentTr.nextElementSibling;
              const container = detailRow.querySelector('.children-list');

              if (!container) {
                  console.error('Container topilmadi!');
                  return;
              }

              container.innerHTML = '';
              const nestedUl = renderChildren(children, 1);
              container.appendChild(nestedUl);
          });
      });
  </script>

@endsection
