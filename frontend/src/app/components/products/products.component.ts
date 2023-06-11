import { Component } from '@angular/core';
import { ColDef, GridOptions } from 'ag-grid-community';
import { BaseService } from '../../services/base.service';
import { NotifyService } from '../../services/notify.service';
import { Iproduct } from '../../models/iproduct';
import { ActionCellRenderer } from '../../shared/actionCell.component';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})

export class ProductsComponent {
  // Holds all products data
  rowData: any = [];

  // To define column definations
  columnDefs: ColDef[] = [
    {field:'id', width: 50},
    {field:'name'},
    {field:'state', width: 100},
    {field:'zip', width:100},
    {editable: true, field:'amount', width:100},
    {editable: true, field:'quantity', width:100},
    {field:'item', width:100},
    {
      headerName: "Action",
      minWidth: 150,
      cellRenderer: ActionCellRenderer,
      editable: false,
      colId: "action"
    }
  ];
  
  // To define default column definations which is applicable for all columns
  defaultColDef = {
    sortable: true
  };

  constructor(
    private baseService: BaseService,
    private notifyService: NotifyService) {
  }
  
/**
 * Retrives data from add product components.
 * Send new product data to service to create
 * @param {Iproduct} event The event must be new product data.
 */
  createProduct($event:Iproduct){
    this.baseService.addProducts($event).subscribe((resp) => {
      this.notifyService.setNewNotification({success:true,msg:resp.message})
      this.baseService.getProducts().subscribe((resp) => {
        this.rowData = resp.data;
      });
    });
  }

/**
 * On grid ready loads product list.
 * @param {any} params The params is ag-grid api event data.
 */
  onGridReady(params:any) {
    this.baseService.getProducts().subscribe((resp) => {
      this.rowData = resp.data;
    });
  }

/**
 * To handle each action button click.
 * @param {any} params The params is ag-grid api event data.
 */
  onCellClicked(params:any) {
    if (params.column.colId === "action" && params.event.target.dataset.action) {
      let action = params.event.target.dataset.action;
      
      // On click of edit, shows updated and cancel buttons
      if (action === "edit") {
        params.api.startEditingCell({
          rowIndex: params.node.rowIndex,
          colKey: params.columnApi.getDisplayedCenterColumns()[0].colId
        });
      }

      // On click of delete, deletes the product
      if (action === "delete") {
        params.api.applyTransaction({
          remove: [params.node.data]
        });
        this.baseService.deleteProducts(params.node.data).subscribe((resp) => {
          this.notifyService.setNewNotification({success:true,msg:resp.message})
        });
      }

      // On click of update, updated value sent to update api
      if (action === "update") {
        params.api.stopEditing(false);
        this.baseService.updateProducts(params.node.data).subscribe((resp) => {
          // Alerts the response message
          this.notifyService.setNewNotification({success:true,msg:resp.message})
        });

      }

      // On click of cancel, stops the editing
      if (action === "cancel") {
        params.api.stopEditing(true);
      }
    }
  }

/**
 * To track row changes for updating product.
 * @param {any} params The params is ag-grid api event data.
 */
  onRowEditingStarted(params:any) {
    params.api.refreshCells({
      columns: ["action"],
      rowNodes: [params.node],
      force: true
    });
  }

/**
 * Handles when row editing stops.
 * @param {any} params The params is ag-grid api event data.
 */
  onRowEditingStopped(params:any) {
    params.api.refreshCells({
      columns: ["action"],
      rowNodes: [params.node],
      force: true
    });
  }

}
