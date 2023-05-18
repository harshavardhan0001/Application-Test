import { Component } from '@angular/core';
import { ICellRendererAngularComp } from 'ag-grid-angular';
import { ICellRendererParams } from 'ag-grid-community';

@Component({
  selector: 'cell-action-buttons',
  template: `
  <div *ngIf='isCurrentRowEditing'>
    <button  class="btn btn-outline-info"  data-action="update"> Update  </button>
    <button  class="btn btn-outline-secondary"  data-action="cancel" > Cancel </button></div>
  <div *ngIf='!isCurrentRowEditing'>
    <button class="btn btn-outline-success"  data-action="edit" > Edit  </button>
    <button class="btn btn-outline-danger" data-action="delete" > Delete </button>
  </div>`,
})

export class ActionCellRenderer implements ICellRendererAngularComp {
  public isCurrentRowEditing: boolean = false;
// To define buttons to show on load
  agInit(params: ICellRendererParams): void {
    let editingCells = params.api.getEditingCells();
    this.isCurrentRowEditing = editingCells.some((cell:any) => {
      return cell.rowIndex === params.node.rowIndex;
    });

  }
// Get the cell to refresh. Return true if successful. Return false if not (or you don't have refresh logic), then the grid will refresh the cell for you. 
  refresh(params: ICellRendererParams) {
    return false;
  }
}