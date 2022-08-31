# Spryker FAQ module documentation

## Overwiev

This module provides easy to add and use Spryker FAQ utility.
It allows end users to view and manage frequently asked questions as well as
vote for the FAQs which users find helpfull.

The FAQ module provides:
- Zed Backoffice Panel to manage FAQ entries
- Yves frontend panel for all users and voting functionality for logged-in customers
- Glue API interface for external integration
- Data loaders for quick and easy initialization

## Zed


### Agent guide

The main panel is available in the backoffice at url: [/faq/list](http://backoffice.de.spryker.local/faq/list).
You can also get there through sidebar by navigating to "FAQ" section.

Panel allows to perform all necesary operaions on all registered in database FAQ entries.
**Create new faq** button navigates to form which allow to create new faq entry.
Upon registration new FAQ entry can be found in the table in the main panel, which allows to edit, disable, enable and delete entries. Localization is not supported for now.


### Data structures

To communicate with Facade module provides transfer objects listed below:

:::info
Mind that all transfer objects have "Transfer" suffix.
:::
![](https://i.imgur.com/HuEwt1C.png)

- **FaqCollectionTransfer**
  Transfer object enabling data collecting
- **FaqVoteTransfer**
  Single vote entry
- **PaginationTransfer**
  Object providing pagiantion settings
- **FaqVoteCollectionTransger**
  Collection of all votes
- **FaqVoteTransfer**
  Single faq entry

### Facade

Business layer facade provides convenient interface to manage FAQ:


```cpp=
public function createFaqEntity(FaqTransfer $trans): FaqTransfer;
```
Creates FAQ entity from provided FAQ entity. Answer, Question and Enabled field are required.



```cpp=
public function updateFaqEntity(FaqTransfer $trans): FaqTransfer;
```
Updates FAQ entity. On top of create method requirements, IdFaq must be provided.

```cpp=
public function deleteFaqEntity(FaqTransfer $trans): void;
```
Deletes entry by IdFaq

```cpp=
public function findFaqEntityById(int $id): ?FaqTransfer;
```
Finds Faq Entry by idFaq. If not found null is returned.


```cpp=
public function getFaqEntity(FaqTransfer $trans): ?FaqTransfer;
```
Same as previous function.


```cpp=
public function getFaqVoteById(FaqVoteTransfer $trans): FaqVoteTransfer;
```
Checks if user indetified by IdCustomer voted for Faq indetified by IdFaq. Results are stored in the Voted field of the transfer.

```cpp=
public function addFaqVote(FaqVoteTransfer $trans): FaqVoteTransfer;
```
Adds vote for given Faq by Customer.

```cpp=
public function revokeFaqVote(FaqVoteTransfer $trans): void;
```
Deletes vote


```cpp=
public function getFaqCollection(FaqCollectionTransfer $trans): FaqCollectionTransfer;
```
Returns collection of FAQ entries.

Results can be customized:
- If Id of customer is provided each FaqEntry will contain information wheather user voted for this entry, otherwise null is provided.
- If Pagination object is set. Results will be paginated accordingly.



```cpp=
public function getFaqVoteCollection(FaqVoteCollectionTransfer $trans): FaqVoteCollectionTransfer;
```
Returns set of FAQs user has voted for.

### Gateway endpoints

Module provides cross-module communication via gateway controller:

- **/faq/gateway/set-faq-vote**
  (FaqVoteTransfer -> FaqVoteTransfer)

  Deletes user vote if vote if set to false and adds it otherwise

- **/faq/gateway/get-faq-collection**
  (FaqCollectionTransfer -> FaqCollectionTransfer)

  Populates Transfer with FAQ entries. If pagination and/or idCustomer is provided data will be modified accordingly.

- **/faq/gateway/getFaqEntity**
  **/faq/gateway/updateFaqEntity**
  **/faq/gateway/deleteFaqEntity**
  **/faq/gateway/createFaqEntity**
  (FaqTransfer -> FaqTransfer)

  CRUD endpoints for Faq management
  Facade's documentation applies


- **/faq/gateway/getFaqVoteCollection**
  (FaqVoteCollectionTransfer -> FaqVoteCollectionTransfer)

- **/faq/gateway/getFaqVoteById**
  (FaqVoteTransfer -> FaqVoteTransfer)


## Glue REST API

Module provides set of endpoints FAQ management:

| URL                  | Method | Bearer Token | Type      | Attributes                     | Description                                                                                                             |
| -------------------- | ------ | ------------ | --------- | ------------------------------ | ----------------------------------------------------------------------------------------------------------------------- |
| /faq-get/{?id}       | GET    | Optional     | NA        | NA                             | Yields set of faqs or a single entry if id is provided. If bearer token is provided, user votes field will be populated |
| /faqs                | POST   | Required     | faqs      | question:string, answer:string | Adds Faq entries                                                                                                        |
| /faqs/id             | PATCH  | Required     | faqs      | question:string, answer:string | Updates Faq entry                                                                                                       |
| /faqs/id             | DELETE | Required     | faqs      | question:string, answer:string | Deletes Faq entry                                                                                                       |
| /faq-votes-get/{?id} | GET    | Required     | NA        | NA                             | Gets set of user votes or single entry if id is provided                                                                |
| /faq-votes           | POST   | Required     | faq-votes | id_faq:int, voted:bool         | Updates user vote. It is unified endpint for creating, updating and deleting user votes                                 |


## Yves

Faq view is available at the /faq path. Results are paginated by default.
Voting is available for logged in customers only.


## Dataloader

Module provides data loaders to quickly populate FAQ database

File is available at:
/data/import/local/common/faq.csv

To load data use command:
```console data:import:faq```









