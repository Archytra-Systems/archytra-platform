# Architectural Covenant: System Design & Standards

## 1. Core Philosophy
Our system prioritizes **Cohesion over Granularity**. We avoid "file-itis" (the proliferation of discrete Action files) by ensuring our logic is grouped by **Domain Context** (e.g., `User`, `JobOrder`), not by individual operations. We are building a system, not a script collection.

## 2. The Service Layer (Command Side)
The Service Layer is the authoritative gateway for all **Write/Mutation** operations.

*   **The "One Service" Rule:** All business logic for a domain must live in its designated Service (e.g., `UserService`). You shall not create separate `CreateUserAction` or `DeleteUserAction` classes.
*   **Interface-Driven:** Services must type-hint against Repository Interfaces, never concrete implementations. 
*   **Immutable Workflow:** Services accept DTOs as input and return Domain Objects or primitives. Avoid accessing global state (like `auth()` or `session()`) inside services; pass required data explicitly.

## 3. The Query Layer (Read Side)
The Query Layer is strictly dedicated to **Read/Fetch** operations.

*   **Separation of Concerns:** Read logic is strictly separated from Write logic. Fetching data for a report or a list belongs in a `QueryService` (e.g., `UserQueryService`), never in the `UserService`.
*   **Read-Only Purity:** Query Services must not perform any mutations (no `update`, `create`, or `delete` calls).
*   **Projection Focus:** Query Services return view-ready data. They use `QueryDTOs` to handle complex filtering criteria and ensure consistent data shapes.

## 4. DTO Strategy
*   **Domain-Centricity:** DTOs are defined by the **Domain Entity** (`User`), not the **Action**.
*   **Composition Over Flatness:** If a DTO exceeds 15 properties, use **Nested Composition** (grouping related data into sub-DTOs) rather than flattening or creating new files.
*   **Single-Source Projection:** Use static factory methods (`fromModel`, `fromList`, `fromRequest`) within the DTO to transform data. This keeps the DTO as the single source of truth for the data "shape."

## 5. Refactoring Thresholds
If you find yourself violating the **Single Responsibility Principle**, use these thresholds to decide whether to refactor:

| Trigger | Threshold / Symptom | Decision |
| :--- | :--- | :--- |
| **Service Size** | Service exceeds 500 lines or 15 public methods. | **Refactor:** Split by sub-domain. |
| **Query Logic** | `QueryService` contains logic to "save" or "transform" data. | **Refactor:** Move logic to `Service` (Command side). |
| **Usage Ratio** | > 80% of DTO constructor arguments are `null` in workflows. | **Refactor:** Create a specific Projection DTO. |
| **SRP Violation** | DTO contains properties for unrelated contexts (e.g., HR & Auth). | **Refactor:** Split DTOs along Domain Aggregate boundaries. |

## 6. Decision Flowchart
When adding new functionality, follow this check:

1.  **Is this a State Change (Write)?**
    *   **Yes:** Implement in `[Domain]Service`.
    *   **No:** Implement in `[Domain]QueryService`.

2.  **Does the data represent a Domain Entity?**
    *   **Yes:** Add to existing `[Domain]DTO`.
    *   **No, it's a search filter:** Create `[Domain]QueryDTO`.