
<table class="table {{$entityType->isSortable() ?: 'table-striped' }} table-bordered entities">
    
    <thead>
    
    <tr class="head">
        
        @if($entityType->isSortable())
            
            <th>
                <svg class="bi bi-arrow-up-down" width="24" height="24" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11 3.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V4a.5.5 0 01.5-.5z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M10.646 2.646a.5.5 0 01.708 0l3 3a.5.5 0 01-.708.708L11 3.707 8.354 6.354a.5.5 0 11-.708-.708l3-3zm-9 7a.5.5 0 01.708 0L5 12.293l2.646-2.647a.5.5 0 11.708.708l-3 3a.5.5 0 01-.708 0l-3-3a.5.5 0 010-.708z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M5 2.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V3a.5.5 0 01.5-.5z" clip-rule="evenodd" />
                </svg>
            </th>
        @endif
        
        @foreach($entityType->getListFields() as $key)
            <th>
                {{$entityType->getField($key)->getName()}}
            </th>
        
        @endforeach
        
        <th>Состояние</th>
        
        <th>
            Действия
        </th>
    
    </tr>
    </thead>
    
    <tbody>
    
    @foreach($entities as $entity)
        
        <tr style="{{$entity->state === 'draft' ? 'font-style: italic' : ''}}" data-entity-id="{{$entity->id}}">
            
            @if($entityType->isSortable())
                
                <td class="lever">
                    <svg class="bi bi-three-dots-vertical" width="24" height="24" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm0-5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm0-5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" clip-rule="evenodd" />
                    </svg>
                </td>
            @endif
            
            
            @foreach($entityType->getListFields() as $key)
                <td>
                    {{$entity->data($key)}}
                </td>
            @endforeach
            
            <td>
                {{$entity->state === 'draft' ? 'черновик' : 'опубликовано'}}
            </td>
            
            <td style="font-style: normal; min-width: 212px">
                <a href="{{route('admin.entity.edit', [$entity->type, $entity->id])}}" class="btn btn-sm btn-primary">редактировать</a>
                <a href="{{route('admin.entity.destroy', [$entity->type, $entity->id])}}" class="btn btn-sm btn-danger">удалить</a>
            </td>
        </tr>
    
    @endforeach
    
    </tbody>

</table>


@if($entityType->isSortable())
    
    
    <style>
        
        .table tr {
            background: #ffffff;
        }
        
        .table tr td:first-child{
            vertical-align: middle;
        }
        
        .placeholder_row {
            display: table-row;
            height: 40px;
            width: 100%;
            background-color: #eee;
            
        }
        
        .highlight {
            box-shadow: 0px 2px 20px -5px rgba(0, 0, 0, 0.5);
        }
    </style>
    
    
    
    <script type="text/javascript">
      $(function () {

        $('.entities tbody').sortable(
          {
            handle: '.lever',
            placeholder: 'placeholder_row',
            axis: 'y',
            revert: 200,
            classes: {
              'ui-sortable-helper': 'highlight'
            },
            update: function (event, ui) {

              var ids = []

              $('[data-entity-id]').each(function (index) {

                ids.push($(this).data('entity-id'))

              })
              
              $.post('{{route('admin.entity.set_positions')}}', {entity_ids: ids}, function(data){
              
                //
              
              }, 'json')


            }

          }
        )

      })
    </script>

@endif
