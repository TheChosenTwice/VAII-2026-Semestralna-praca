# Diskusné fórum
Tomáš Hurtoš
5ZYI34
## Stručný opis projektu

Cieľom projektu je vytvoriť jednoduchú webovú aplikáciu – diskusné fórum, v ktorom môžu používatelia zakladať diskusné témy a diskutovať o rôznych otázkach. Aplikácia bude slúžiť ľuďom, ktorí chcú zdieľať svoje názory, vymieňať si skúsenosti alebo získavať rady od ostatných používateľov.

Webová stránka bude umožňovať prezeranie diskusií, registráciu používateľov, pridávanie nových tém a písanie príspevkov. Súčasťou aplikácie bude aj správca, ktorý bude dohliadať na obsah a správne fungovanie fóra.

## Role v projekte

- **Návštevník:** Môže si prezerať diskusné témy a jednotlivé príspevky. Nemôže pridávať nové témy ani odpovede.
- **Registrovaný používateľ:** Môže vytvárať nové diskusné témy, písať odpovede a upravovať alebo mazať svoje príspevky.
- **Správca:** Môže spravovať používateľov, mazať nevhodné témy a príspevky a dohliadať na obsah fóra.

## Prípady použitia podľa rolí

**Návštevník**
- Zobrazí si zoznam diskusných tém.
- Otvorí si vybranú tému a prečíta si príspevky.
- Vyhľadá diskusnú tému podľa názvu.

**Registrovaný používateľ**
- Zaregistruje sa a prihlási sa do aplikácie.
- Vytvorí novú diskusnú tému.
- Pridá odpoveď do existujúcej diskusie.
- Upraví alebo vymaže vlastný príspevok.
- Odhlási sa z aplikácie.

**Správca**
- Zobrazí si zoznam používateľov.
- Odstráni nevhodné témy alebo príspevky.
- Vymaže používateľský účet v prípade potreby.

## Plánované entity

- **Používateľ:** Uchováva informácie o registrovaných používateľoch. Atribúty: ID, používateľské meno, e-mail, heslo a rola. Používateľ môže vytvárať témy a pridávať príspevky.
- **Diskusná téma:** Predstavuje začiatok novej diskusie. Atribúty: ID, názov, úvodný text a dátum vytvorenia. Každá téma má svojho autora a môže patriť do jednej kategórie.
- **Príspevok:** Predstavuje odpoveď používateľa v diskusii. Atribúty: ID, text príspevku a dátum vytvorenia. Každý príspevok patrí jednému používateľovi a jednej diskusnej téme.

## Vzťahy medzi entitami

- **Používateľ – Diskusná téma (1:N):** Jeden používateľ môže vytvoriť viacero diskusných tém, ale každá téma má jedného autora.
- **Používateľ – Príspevok (1:N):** Jeden používateľ môže napísať viacero príspevkov, ale každý príspevok má jedného autora.
- **Kategória – Diskusná téma (1:N):** Jedna kategória môže obsahovať viacero tém, ale každá téma patrí do jednej kategórie.
- **Diskusná téma – Príspevok (1:N):** Jedna diskusná téma môže obsahovať viacero príspevkov, ale každý príspevok patrí do jednej témy.

## Hlavné stránky aplikácie

1. **Úvodná stránka:** Zobrazí najnovšie diskusné témy a základné informácie o fóre.
2. **Zoznam diskusií:** Zobrazí všetky diskusné témy a umožní vyhľadávanie podľa názvu.
3. **Detail diskusie:** Zobrazí vybranú tému a všetky odpovede používateľov.
4. **Registrácia:** Umožní novému používateľovi vytvoriť si účet.
5. **Prihlásenie:** Umožní registrovanému používateľovi prihlásiť sa do aplikácie.
6. **Vytvorenie diskusie:** Umožní používateľovi zadať názov témy, text a vybrať kategóriu.
7. **Správa fóra:** Stránka určená správcovi na kontrolu a odstraňovanie nevhodného obsahu.

## Rozdelenie funkcionality

**Základné funkcie**
- Registrácia a prihlásenie používateľa.
- Zobrazovanie diskusných tém a príspevkov.
- Vytváranie nových diskusných tém.
- Pridávanie odpovedí do diskusií.
- Mazanie vlastných príspevkov.
- Základné oprávnenia pre návštevníka, používateľa a správcu.
- Ukladanie používateľov, tém a príspevkov do databázy.

**Rozširujúce funkcie**
- Vyhľadávanie diskusií podľa názvu.
- Úprava vlastných príspevkov.
- Rozdelenie diskusií do kategórií.
- Úprava používateľského profilu.
- Zobrazovanie najnovších diskusií ako prvých.
- Možnosť správcu spravovať používateľské účty.
